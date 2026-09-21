<?php

declare(strict_types=1);

namespace App\Livewire\Pelayanan\Auth;

use App\Services\Pelayanan\ApplicantRateLimiter;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    /**
     * @return array<string, array<int, string>>
     */
    protected function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function messages(): array
    {
        return [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ];
    }

    public function authenticate(?ApplicantRateLimiter $rateLimiter = null): void
    {
        $rateLimiter ??= app(ApplicantRateLimiter::class);

        $this->validate();

        // Cek apakah akun atau IP sedang dalam masa temporary block (> 20 kegagalan)
        if ($rateLimiter->isBlocked($this->email)) {
            $seconds = $rateLimiter->availableIn($this->email);
            $minutes = (int) ceil($seconds / 60);
            $timeText = $seconds >= 60 ? "{$minutes} menit" : "{$seconds} detik";

            $this->addError(
                'email',
                "Terlalu banyak percobaan masuk yang gagal. Akses masuk ditangguhkan sementara. Silakan coba lagi dalam {$timeText}."
            );
            $this->password = '';

            return;
        }

        // Terapkan progressive throttle delay jika berada pada Level 1 (2s) atau Level 2 (10s)
        $level = $rateLimiter->getThrottleLevel($this->email);
        $delay = $rateLimiter->getThrottleDelay($level);
        if ($delay > 0) {
            $rateLimiter->applyThrottleDelay($delay);
        }

        if (! Auth::guard('applicant')->attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $rateLimiter->recordFailure($this->email);

            if ($rateLimiter->isBlocked($this->email)) {
                $seconds = $rateLimiter->availableIn($this->email);
                $minutes = (int) ceil($seconds / 60);
                $timeText = $seconds >= 60 ? "{$minutes} menit" : "{$seconds} detik";

                $this->addError(
                    'email',
                    "Batas percobaan masuk telah habis. Akses masuk ditangguhkan selama {$timeText} demi keamanan."
                );
            } else {
                $this->addError(
                    'email',
                    'Alamat email atau kata sandi yang Anda masukkan tidak sesuai.'
                );
            }

            $this->password = '';

            return;
        }

        $rateLimiter->reset($this->email);

        $applicant = Auth::guard('applicant')->user();

        if ($applicant && ! $applicant->is_active) {
            Auth::guard('applicant')->logout();
            $this->addError('email', 'Akun Anda saat ini dinonaktifkan. Silakan hubungi petugas Stasiun Geofisika Balikpapan.');
            $this->password = '';

            return;
        }

        session()->regenerate();

        session()->flash('status', 'Berhasil masuk ke layanan.');

        $this->redirectIntended(route('filament.pelayanan.pages.dashboard'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.pelayanan.auth.login')
            ->layout('components.layouts.auth')
            ->title('Masuk - Layanan Data Stasiun Geofisika Balikpapan');
    }
}
