<?php

declare(strict_types=1);

namespace Tests\Feature\Pelayanan;

use App\Livewire\Pelayanan\Auth\Login;
use App\Models\Applicant;
use App\Services\Pelayanan\ApplicantRateLimiter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class ApplicantLoginRateLimitTest extends TestCase
{
    use RefreshDatabase;

    protected ApplicantRateLimiter $rateLimiter;
    protected int $totalDelayApplied = 0;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rateLimiter = new ApplicantRateLimiter();
        $this->totalDelayApplied = 0;

        // Gunakan custom mock sleeper agar test tidak lambat menunggu sleep nyata
        $this->rateLimiter->setSleeper(function (int $seconds): void {
            $this->totalDelayApplied += $seconds;
        });

        $this->app->instance(ApplicantRateLimiter::class, $this->rateLimiter);
    }

    protected function tearDown(): void
    {
        $this->rateLimiter->setSleeper(null);
        parent::tearDown();
    }

    public function test_failed_login_returns_generic_error_and_increments_counter(): void
    {
        $email = 'unknown_user@example.com';
        $this->rateLimiter->reset($email);

        Livewire::test(Login::class)
            ->set('email', $email)
            ->set('password', 'wrong-password')
            ->call('authenticate')
            ->assertHasErrors(['email'])
            ->assertSee('Alamat email atau kata sandi yang Anda masukkan tidak sesuai.');

        $this->assertSame(1, $this->rateLimiter->getAccountAttempts($email));
        $this->rateLimiter->reset($email);
    }

    public function test_mild_throttle_triggers_2_seconds_delay_on_level_1(): void
    {
        $email = 'mild_throttle@example.com';
        $this->rateLimiter->reset($email);

        // Lakukan 5 kegagalan (Level 0)
        for ($i = 1; $i <= 5; $i++) {
            Livewire::test(Login::class)
                ->set('email', $email)
                ->set('password', 'wrong')
                ->call('authenticate');
        }
        $this->assertSame(0, $this->totalDelayApplied);

        // Percobaan ke-6 (Level 1) harus menerapkan delay 2 detik
        Livewire::test(Login::class)
            ->set('email', $email)
            ->set('password', 'wrong')
            ->call('authenticate');

        $this->assertSame(2, $this->totalDelayApplied);
        $this->rateLimiter->reset($email);
    }

    public function test_strong_throttle_triggers_10_seconds_delay_on_level_2(): void
    {
        $email = 'strong_throttle@example.com';
        $this->rateLimiter->reset($email);

        // Lakukan 10 kegagalan
        for ($i = 1; $i <= 10; $i++) {
            $this->rateLimiter->recordFailure($email);
        }

        $this->totalDelayApplied = 0;

        // Percobaan ke-11 (Level 2) harus menerapkan delay 10 detik
        Livewire::test(Login::class)
            ->set('email', $email)
            ->set('password', 'wrong')
            ->call('authenticate');

        $this->assertSame(10, $this->totalDelayApplied);
        $this->rateLimiter->reset($email);
    }

    public function test_temporary_block_is_enforced_when_failures_exceed_20(): void
    {
        $email = 'blocked_user@example.com';
        $this->rateLimiter->reset($email);

        // Simulasikan 20 kegagalan
        for ($i = 1; $i <= 20; $i++) {
            $this->rateLimiter->recordFailure($email);
        }

        // Kegagalan ke-21 memicu blokir Level 3
        Livewire::test(Login::class)
            ->set('email', $email)
            ->set('password', 'wrong')
            ->call('authenticate')
            ->assertHasErrors(['email'])
            ->assertSee('Batas percobaan masuk telah habis');

        $this->assertTrue($this->rateLimiter->isBlocked($email));

        // Percobaan berikutnya langsung ditolak tanpa diproses
        Livewire::test(Login::class)
            ->set('email', $email)
            ->set('password', 'any-pass')
            ->call('authenticate')
            ->assertHasErrors(['email'])
            ->assertSee('Terlalu banyak percobaan masuk yang gagal');

        $this->rateLimiter->reset($email);
    }

    public function test_successful_login_resets_both_account_and_ip_counters(): void
    {
        $email = 'success_user@example.com';
        $password = 'Secret123!';

        $applicant = Applicant::create([
            'name' => 'Budi Pemohon',
            'identity_number' => '6471012345678901',
            'tipe_pemohon' => 'pribadi',
            'phone' => '08123456789',
            'email' => $email,
            'password' => Hash::make($password),
            'is_active' => true,
        ]);

        $this->rateLimiter->reset($email);

        // Buat beberapa kegagalan sebelumnya
        for ($i = 1; $i <= 7; $i++) {
            $this->rateLimiter->recordFailure($email);
        }

        $this->assertSame(7, $this->rateLimiter->getAccountAttempts($email));

        // Login dengan kredensial benar
        Livewire::test(Login::class)
            ->set('email', $email)
            ->set('password', $password)
            ->call('authenticate')
            ->assertHasNoErrors()
            ->assertRedirect(route('filament.pelayanan.pages.dashboard'));

        // Counter harus kembali 0
        $this->assertSame(0, $this->rateLimiter->getAccountAttempts($email));
        $this->assertSame(0, $this->rateLimiter->getIpAttempts());

        $this->rateLimiter->reset($email);
    }
}
