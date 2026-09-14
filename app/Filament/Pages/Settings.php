<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class Settings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected string $view = 'filament.pages.settings';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Pengaturan Akun';

    public ?array $passwordData = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Ubah Kata Sandi')
                    ->description('Pastikan akun Anda menggunakan kata sandi yang kuat dan acak agar tetap aman.')
                    ->schema([
                        TextInput::make('current_password')
                            ->label('Kata Sandi Saat Ini')
                            ->password()
                            ->required()
                            ->revealable()
                            ->currentPassword(), // Validasi otomatis mengecek password lama

                        TextInput::make('new_password')
                            ->label('Kata Sandi Baru')
                            ->password()
                            ->required()
                            ->revealable()
                            ->rule(Password::default())
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->same('new_password_confirmation'),

                        TextInput::make('new_password_confirmation')
                            ->label('Konfirmasi Kata Sandi Baru')
                            ->password()
                            ->required()
                            ->revealable()
                            ->dehydrated(false), // Jangan masukkan field ini ke array data yg diproses
                    ]),
            ])
            ->statePath('passwordData');
    }

    public function save(): mixed
    {
        $data = $this->form->getState();

        // 1. Update password ke database
        auth()->user()->update([
            'password' => $data['new_password'],
        ]);

        // 2. Proses Logout dan Bersihkan Sesi Lama
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        // 3. Kirim notifikasi sukses (ditaruh SETELAH sesi baru dibuat agar tidak ikut terhapus)
        Notification::make()
            ->success()
            ->title('Kata Sandi Berhasil Diperbarui')
            ->body('Silakan login kembali menggunakan kata sandi baru Anda.')
            ->send();

        // 4. Arahkan pengguna kembali ke halaman login bawaan Filament
        return redirect(filament()->getLoginUrl());
    }
}
