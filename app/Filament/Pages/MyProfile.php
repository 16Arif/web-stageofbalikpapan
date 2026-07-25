<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Password;

class MyProfile extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected string $view = 'filament.pages.my-profile';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Edit Data Profil';

    public ?array $profileData = [];

    public function mount(): void
    {
        $this->form->fill([
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Akun')
                    ->description('Perbarui nama dan alamat email Anda di sini.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Alamat Email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(table: 'users', ignorable: auth()->user()),
                    ]),
            ])
            ->statePath('profileData');
    }

    public function save(): void
    {
        auth()->user()->update($this->form->getState());

        Notification::make()
            ->success()
            ->title('Data berhasil diperbarui')
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('resetPassword')
                ->label('Ubah Password (Via Email)')
                ->color('warning')
                ->icon('heroicon-o-envelope')
                ->requiresConfirmation()
                ->modalHeading('Kirim Link Ubah Password?')
                ->modalDescription('Sistem akan mengirimkan link khusus ke email Anda untuk mengatur ulang kata sandi.')
                ->modalSubmitActionLabel('Kirim Link')
                ->action(function () {
                    $status = Password::broker()->sendResetLink(
                        ['email' => auth()->user()->email]
                    );

                    if ($status === Password::RESET_LINK_SENT) {
                        Notification::make()->success()->title('Link Terkirim!')->send();
                    } else {
                        Notification::make()->danger()->title('Gagal mengirim link')->body(__($status))->send();
                    }
                }),
        ];
    }
}
