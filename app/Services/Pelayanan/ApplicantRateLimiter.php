<?php

declare(strict_types=1);

namespace App\Services\Pelayanan;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class ApplicantRateLimiter
{
    public const int LEVEL_NORMAL = 0;
    public const int LEVEL_MILD = 1;
    public const int LEVEL_STRONG = 2;
    public const int LEVEL_BLOCKED = 3;

    public const int MAX_FAILURES_BEFORE_BLOCK = 20;
    public const int WINDOW_DECAY_SECONDS = 900; // 15 menit
    public const int BLOCK_DURATION_SECONDS = 900; // 15 menit

    public const int DELAY_LEVEL_MILD = 2; // 2 detik
    public const int DELAY_LEVEL_STRONG = 10; // 10 detik

    /**
     * Closure untuk menjalankan jeda (delay). Dapat dimodifikasi pada saat testing.
     */
    protected ?Closure $sleeper = null;

    /**
     * Normalisasi identifier login (email) agar case-insensitive dan bersih dari whitespace.
     */
    public function normalizeEmail(string $email): string
    {
        return Str::transliterate(Str::lower(trim($email)));
    }

    /**
     * Dapatkan kunci rate limit untuk akun (identifier).
     */
    public function getAccountKey(string $email): string
    {
        return 'applicant_auth:account:' . $this->normalizeEmail($email);
    }

    /**
     * Dapatkan kunci rate limit untuk alamat IP.
     */
    public function getIpKey(?string $ip = null): string
    {
        $clientIp = $ip ?? request()->ip() ?? '127.0.0.1';

        return 'applicant_auth:ip:' . trim($clientIp);
    }

    /**
     * Ambil jumlah kegagalan yang tercatat untuk akun.
     */
    public function getAccountAttempts(string $email): int
    {
        return RateLimiter::attempts($this->getAccountKey($email));
    }

    /**
     * Ambil jumlah kegagalan yang tercatat untuk IP.
     */
    public function getIpAttempts(?string $ip = null): int
    {
        return RateLimiter::attempts($this->getIpKey($ip));
    }

    /**
     * Ambil jumlah kegagalan efektif (nilai tertinggi antara account dan IP).
     */
    public function getEffectiveAttempts(string $email, ?string $ip = null): int
    {
        return max($this->getAccountAttempts($email), $this->getIpAttempts($ip));
    }

    /**
     * Tentukan level throttling saat ini berdasarkan kegagalan efektif:
     * - Level 0: 0-5 kali gagal (Normal, 0s)
     * - Level 1: 6-10 kali gagal (Mild, 2s)
     * - Level 2: 11-20 kali gagal (Strong, 10s)
     * - Level 3: > 20 kali gagal (Temporary Block)
     */
    public function getThrottleLevel(string $email, ?string $ip = null): int
    {
        $attempts = $this->getEffectiveAttempts($email, $ip);

        if ($attempts > self::MAX_FAILURES_BEFORE_BLOCK) {
            return self::LEVEL_BLOCKED;
        }

        if ($attempts >= 10) {
            return self::LEVEL_STRONG;
        }

        if ($attempts >= 5) {
            return self::LEVEL_MILD;
        }

        return self::LEVEL_NORMAL;
    }

    /**
     * Dapatkan durasi jeda (detik) sesuai level throttling.
     */
    public function getThrottleDelay(int $level): int
    {
        return match ($level) {
            self::LEVEL_MILD => self::DELAY_LEVEL_MILD,
            self::LEVEL_STRONG => self::DELAY_LEVEL_STRONG,
            default => 0,
        };
    }

    /**
     * Cek apakah akun atau IP sedang dalam masa temporary block (> 20 failures).
     */
    public function isBlocked(string $email, ?string $ip = null): bool
    {
        $accountKey = $this->getAccountKey($email);
        $ipKey = $this->getIpKey($ip);

        $accountAttempts = RateLimiter::attempts($accountKey);
        $ipAttempts = RateLimiter::attempts($ipKey);

        $accountBlocked = $accountAttempts > self::MAX_FAILURES_BEFORE_BLOCK;
        $ipBlocked = $ipAttempts > self::MAX_FAILURES_BEFORE_BLOCK;

        if (! $accountBlocked && ! $ipBlocked) {
            return false;
        }

        // Pastikan timer masih aktif. Jika timer sudah habis, RateLimiter membersihkan hit secara otomatis
        $accountTimer = RateLimiter::availableIn($accountKey);
        $ipTimer = RateLimiter::availableIn($ipKey);

        if ($accountBlocked && $accountTimer === 0) {
            RateLimiter::clear($accountKey);
            $accountBlocked = false;
        }

        if ($ipBlocked && $ipTimer === 0) {
            RateLimiter::clear($ipKey);
            $ipBlocked = false;
        }

        return $accountBlocked || $ipBlocked;
    }

    /**
     * Ambil sisa waktu penangguhan dalam detik (nilai tertinggi antara account dan IP).
     */
    public function availableIn(string $email, ?string $ip = null): int
    {
        $accountAvailable = RateLimiter::availableIn($this->getAccountKey($email));
        $ipAvailable = RateLimiter::availableIn($this->getIpKey($ip));

        return max($accountAvailable, $ipAvailable);
    }

    /**
     * Terapkan delay sebelum memproses request sesuai level progresif.
     */
    public function applyThrottleDelay(int $seconds): void
    {
        if ($seconds <= 0) {
            return;
        }

        if ($this->sleeper !== null) {
            ($this->sleeper)($seconds);

            return;
        }

        sleep($seconds);
    }

    /**
     * Catat kegagalan login pada akun dan IP pemohon.
     */
    public function recordFailure(string $email, ?string $ip = null): void
    {
        $accountKey = $this->getAccountKey($email);
        $ipKey = $this->getIpKey($ip);

        RateLimiter::hit($accountKey, self::WINDOW_DECAY_SECONDS);
        RateLimiter::hit($ipKey, self::WINDOW_DECAY_SECONDS);

        // Jika mencapai batas pemblokiran (> 20 kali), tetapkan waktu blokir selama 15 menit penuh
        if (RateLimiter::attempts($accountKey) > self::MAX_FAILURES_BEFORE_BLOCK) {
            $this->ensureBlockTimer($accountKey, self::BLOCK_DURATION_SECONDS);
        }

        if (RateLimiter::attempts($ipKey) > self::MAX_FAILURES_BEFORE_BLOCK) {
            $this->ensureBlockTimer($ipKey, self::BLOCK_DURATION_SECONDS);
        }
    }

    /**
     * Reset counter kegagalan untuk akun dan IP (dipanggil setelah login sukses).
     */
    public function reset(string $email, ?string $ip = null): void
    {
        RateLimiter::clear($this->getAccountKey($email));
        RateLimiter::clear($this->getIpKey($ip));
    }

    /**
     * Custom sleeper untuk mempermudah dan mempercepat unit/feature test tanpa sleep nyata.
     */
    public function setSleeper(?Closure $sleeper): void
    {
        $this->sleeper = $sleeper;
    }

    /**
     * Memperbarui timer blokir pada cache key rate limiter.
     */
    protected function ensureBlockTimer(string $key, int $durationSeconds): void
    {
        $cleanKey = RateLimiter::cleanRateLimiterKey($key);
        Cache::put($cleanKey . ':timer', now()->addSeconds($durationSeconds)->getTimestamp(), $durationSeconds);
    }
}
