<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\Pelayanan\ApplicantRateLimiter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\RateLimiter;
use Tests\TestCase;

class ApplicantRateLimiterTest extends TestCase
{
    protected ApplicantRateLimiter $limiter;

    protected function setUp(): void
    {
        parent::setUp();
        $this->limiter = new ApplicantRateLimiter();
    }

    public function test_normalize_email_normalizes_casing_and_whitespace(): void
    {
        $email1 = '  Pemohon.DATA@Bmkg.GO.ID  ';
        $email2 = 'pemohon.data@bmkg.go.id';

        $this->assertSame('pemohon.data@bmkg.go.id', $this->limiter->normalizeEmail($email1));
        $this->assertSame(
            $this->limiter->getAccountKey($email1),
            $this->limiter->getAccountKey($email2)
        );
    }

    public function test_account_and_ip_keys_are_segregated(): void
    {
        $accountKey = $this->limiter->getAccountKey('user@example.com');
        $ipKey = $this->limiter->getIpKey('192.168.1.100');

        $this->assertStringStartsWith('applicant_auth:account:', $accountKey);
        $this->assertStringStartsWith('applicant_auth:ip:', $ipKey);
        $this->assertNotSame($accountKey, $ipKey);
    }

    public function test_record_failure_increments_both_account_and_ip_counters(): void
    {
        $email = 'test_record@example.com';
        $ip = '10.10.10.1';

        $this->limiter->reset($email, $ip);

        $this->assertSame(0, $this->limiter->getAccountAttempts($email));
        $this->assertSame(0, $this->limiter->getIpAttempts($ip));

        $this->limiter->recordFailure($email, $ip);

        $this->assertSame(1, $this->limiter->getAccountAttempts($email));
        $this->assertSame(1, $this->limiter->getIpAttempts($ip));

        $this->limiter->reset($email, $ip);
    }

    public function test_effective_attempts_takes_maximum_between_account_and_ip(): void
    {
        $email = 'target@example.com';
        $ip = '10.10.10.2';

        $this->limiter->reset($email, $ip);

        // Simulasikan 3 kegagalan pada akun
        RateLimiter::hit($this->limiter->getAccountKey($email), 900);
        RateLimiter::hit($this->limiter->getAccountKey($email), 900);
        RateLimiter::hit($this->limiter->getAccountKey($email), 900);

        // Simulasikan 7 kegagalan pada IP (misal dari akun-akun lain)
        for ($i = 0; $i < 7; $i++) {
            RateLimiter::hit($this->limiter->getIpKey($ip), 900);
        }

        $this->assertSame(3, $this->limiter->getAccountAttempts($email));
        $this->assertSame(7, $this->limiter->getIpAttempts($ip));
        $this->assertSame(7, $this->limiter->getEffectiveAttempts($email, $ip));

        $this->limiter->reset($email, $ip);
    }

    public function test_level_0_normal_for_attempts_1_to_5(): void
    {
        $email = 'lvl0@example.com';
        $ip = '10.10.10.3';
        $this->limiter->reset($email, $ip);

        // Saat belum ada kegagalan s.d. 4 kegagalan (percobaan 1 s.d. 5)
        for ($i = 0; $i < 5; $i++) {
            $this->assertSame(ApplicantRateLimiter::LEVEL_NORMAL, $this->limiter->getThrottleLevel($email, $ip));
            $this->assertSame(0, $this->limiter->getThrottleDelay($this->limiter->getThrottleLevel($email, $ip)));
            $this->assertFalse($this->limiter->isBlocked($email, $ip));
            $this->limiter->recordFailure($email, $ip);
        }

        $this->limiter->reset($email, $ip);
    }

    public function test_level_1_mild_throttle_for_attempts_6_to_10(): void
    {
        $email = 'lvl1@example.com';
        $ip = '10.10.10.4';
        $this->limiter->reset($email, $ip);

        // 5 kegagalan awal telah tercatat
        for ($i = 0; $i < 5; $i++) {
            $this->limiter->recordFailure($email, $ip);
        }

        // Percobaan ke-6 s.d. ke-10 (kegagalan tercatat 5 s.d. 9)
        for ($attempt = 6; $attempt <= 10; $attempt++) {
            $level = $this->limiter->getThrottleLevel($email, $ip);
            $this->assertSame(ApplicantRateLimiter::LEVEL_MILD, $level);
            $this->assertSame(2, $this->limiter->getThrottleDelay($level));
            $this->assertFalse($this->limiter->isBlocked($email, $ip));
            $this->limiter->recordFailure($email, $ip);
        }

        $this->limiter->reset($email, $ip);
    }

    public function test_level_2_strong_throttle_for_attempts_11_to_20(): void
    {
        $email = 'lvl2@example.com';
        $ip = '10.10.10.5';
        $this->limiter->reset($email, $ip);

        // 10 kegagalan awal telah tercatat
        for ($i = 0; $i < 10; $i++) {
            $this->limiter->recordFailure($email, $ip);
        }

        // Percobaan ke-11 s.d. ke-20 (kegagalan tercatat 10 s.d. 19)
        for ($attempt = 11; $attempt <= 20; $attempt++) {
            $level = $this->limiter->getThrottleLevel($email, $ip);
            $this->assertSame(ApplicantRateLimiter::LEVEL_STRONG, $level);
            $this->assertSame(10, $this->limiter->getThrottleDelay($level));
            $this->assertFalse($this->limiter->isBlocked($email, $ip));
            $this->limiter->recordFailure($email, $ip);
        }

        $this->limiter->reset($email, $ip);
    }

    public function test_level_3_temporary_block_when_failures_exceed_20(): void
    {
        $email = 'lvl3@example.com';
        $ip = '10.10.10.6';
        $this->limiter->reset($email, $ip);

        // 20 kali gagal masih Level 2
        for ($i = 1; $i <= 20; $i++) {
            $this->limiter->recordFailure($email, $ip);
        }
        $this->assertFalse($this->limiter->isBlocked($email, $ip));

        // Kegagalan ke-21 (> 20) memicu Level 3 (Temporary Block)
        $this->limiter->recordFailure($email, $ip);

        $this->assertSame(ApplicantRateLimiter::LEVEL_BLOCKED, $this->limiter->getThrottleLevel($email, $ip));
        $this->assertTrue($this->limiter->isBlocked($email, $ip));
        $this->assertGreaterThan(0, $this->limiter->availableIn($email, $ip));

        $this->limiter->reset($email, $ip);
    }

    public function test_ip_based_limiting_blocks_ip_even_with_different_accounts(): void
    {
        $ip = '10.10.10.7';
        RateLimiter::clear($this->limiter->getIpKey($ip));

        // 21 user berbeda gagal dari 1 IP yang sama
        for ($i = 1; $i <= 21; $i++) {
            $email = "user_{$i}@example.com";
            $this->limiter->recordFailure($email, $ip);
        }

        // IP tersebut harus terblokir
        $this->assertTrue($this->limiter->isBlocked('brand_new_user@example.com', $ip));
        $this->assertSame(
            ApplicantRateLimiter::LEVEL_BLOCKED,
            $this->limiter->getThrottleLevel('brand_new_user@example.com', $ip)
        );

        RateLimiter::clear($this->limiter->getIpKey($ip));
    }

    public function test_reset_clears_both_account_and_ip(): void
    {
        $email = 'reset_test@example.com';
        $ip = '10.10.10.8';

        for ($i = 1; $i <= 7; $i++) {
            $this->limiter->recordFailure($email, $ip);
        }

        $this->assertSame(7, $this->limiter->getAccountAttempts($email));
        $this->assertSame(7, $this->limiter->getIpAttempts($ip));

        $this->limiter->reset($email, $ip);

        $this->assertSame(0, $this->limiter->getAccountAttempts($email));
        $this->assertSame(0, $this->limiter->getIpAttempts($ip));
        $this->assertSame(ApplicantRateLimiter::LEVEL_NORMAL, $this->limiter->getThrottleLevel($email, $ip));
    }

    public function test_apply_throttle_delay_calls_custom_sleeper(): void
    {
        $sleptSeconds = 0;
        $this->limiter->setSleeper(function (int $seconds) use (&$sleptSeconds): void {
            $sleptSeconds += $seconds;
        });

        $this->limiter->applyThrottleDelay(2);
        $this->assertSame(2, $sleptSeconds);

        $this->limiter->applyThrottleDelay(10);
        $this->assertSame(12, $sleptSeconds);

        $this->limiter->setSleeper(null);
    }

    public function test_window_expiration_clears_failures_after_ttl(): void
    {
        $email = 'expiration_test@example.com';
        $ip = '10.10.10.9';
        $this->limiter->reset($email, $ip);

        $now = Carbon::now();
        Carbon::setTestNow($now);

        for ($i = 0; $i < 5; $i++) {
            $this->limiter->recordFailure($email, $ip);
        }
        $this->assertSame(5, $this->limiter->getEffectiveAttempts($email, $ip));

        // Majukan waktu melewati window 15 menit (901 detik)
        Carbon::setTestNow($now->copy()->addSeconds(901));

        // Karena cache store pada testing adalah array, clear/reset terjadi saat availableIn = 0
        $this->assertSame(0, $this->limiter->availableIn($email, $ip));

        Carbon::setTestNow();
        $this->limiter->reset($email, $ip);
    }
}
