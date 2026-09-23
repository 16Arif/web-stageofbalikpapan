<?php

declare(strict_types=1);

namespace App\Livewire\Pelayanan\Auth;

use App\Models\Applicant;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class Register extends Component
{
    public string $name = '';
    public string $identity_number = '';
    public string $tipe_pemohon = 'pribadi';
    public string $institution_name = '';
    public string $phone = '';
    public string $email = '';
    public string $address = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * @return array<string, array<int, string>>
     */
    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'identity_number' => ['required', 'string', 'max:50'],
            'tipe_pemohon' => ['required', 'in:pribadi,institusi'],
            'institution_name' => ['required_if:tipe_pemohon,institusi', 'nullable', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:applicants,email'],
            'address' => ['nullable', 'string', 'max:500'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function messages(): array
    {
        return [
            'name.required' => 'Nama lengkap wajib diisi.',
            'identity_number.required' => 'Nomor identitas (NIK/NIM/Paspor/NIP) wajib diisi.',
            'tipe_pemohon.required' => 'Tipe pemohon wajib dipilih.',
            'tipe_pemohon.in' => 'Pilihan tipe pemohon tidak valid.',
            'institution_name.required_if' => 'Nama instansi atau perusahaan wajib diisi.',
            'phone.required' => 'Nomor HP / WhatsApp wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'email.unique' => 'Alamat email ini sudah terdaftar sebagai pemohon. Silakan masuk atau gunakan email lain.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal terdiri dari 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ];
    }

    public function updatedTipePemohon(string $value): void
    {
        if ($value === 'pribadi') {
            $this->institution_name = '';
            $this->resetErrorBag('institution_name');
        }
    }

    public function register(): void
    {
        $this->validate();

        $applicant = Applicant::create([
            'name' => $this->name,
            'identity_number' => $this->identity_number,
            'tipe_pemohon' => $this->tipe_pemohon,
            'institution_name' => $this->tipe_pemohon === 'institusi' ? $this->institution_name : null,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address !== '' ? $this->address : null,
            'password' => $this->password,
            'is_active' => true,
        ]);

        Auth::guard('applicant')->login($applicant);

        session()->regenerate();

        session()->flash('status', 'Pendaftaran berhasil! Selamat datang di Portal Layanan Data Stasiun Geofisika Balikpapan.');

        $this->redirectIntended(route('pelayanan'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.pelayanan.auth.register')
            ->layout('components.layouts.auth')
            ->title('Daftar Akun Pemohon - Layanan Data Stasiun Geofisika Balikpapan');
    }
}
