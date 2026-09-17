<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Password;
use Spatie\Permission\Models\Role;

class MyProfile extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected string $view = 'filament.pages.my-profile';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Edit Data Profil';

    public ?array $profileData = [];

    public function mount(): void
    {
        $user = auth()->user();

        $this->form->fill([
            'name' => $user?->name,
            'email' => $user?->email,
            'roles' => $user instanceof User ? $user->roles->pluck('name')->toArray() : [],
        ]);
    }

    public function form(Schema $schema): Schema
    {
        $isSuperAdmin = auth()->user() instanceof User && auth()->user()->hasRole('super_admin');

        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Informasi Akun')
                    ->description('Perbarui nama, alamat email, dan lihat peran akun Anda di sini.')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),

                        \Filament\Forms\Components\TextInput::make('email')
                            ->label('Alamat Email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(table: 'users', ignorable: auth()->user()),

                        \Filament\Forms\Components\Select::make('roles')
                            ->label('Peran (Role)')
                            ->options(
                                Role::query()
                                    ->pluck('name', 'name')
                                    ->mapWithKeys(fn (string $name): array => [
                                        $name => match ($name) {
                                            'super_admin' => 'Super Admin',
                                            'admin' => 'Admin',
                                            'staff' => 'Staff',
                                            default => ucfirst(str_replace('_', ' ', $name)),
                                        },
                                    ])
                            )
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->disabled(! $isSuperAdmin)
                            ->dehydrated($isSuperAdmin)
                            ->helperText(
                                $isSuperAdmin
                                    ? 'Sebagai Super Admin, Anda memiliki hak akses untuk mengubah peran akun ini.'
                                    : 'Hubungi Tim IT Stageof Balikpapan untuk mengubah peran akun Anda.'
                            ),
                    ]),
            ])
            ->statePath('profileData');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $user = auth()->user();

        if ($user instanceof User) {
            if ($user->hasRole('super_admin') && isset($data['roles'])) {
                $user->syncRoles((array) $data['roles']);
            }

            unset($data['roles']);

            $user->update($data);
        }

        \Filament\Notifications\Notification::make()
            ->success()
            ->title('Data berhasil diperbarui')
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('resetPassword')
                ->label('Ubah Password (Via Email)')
                ->color('warning')
                ->icon('heroicon-o-envelope')
                ->requiresConfirmation()
                ->modalHeading('Kirim Link Ubah Password?')
                ->modalDescription('Sistem akan mengirimkan link khusus ke email Anda untuk mengatur ulang kata sandi.')
                ->modalSubmitActionLabel('Kirim Link')
                ->action(function (): void {
                    $user = auth()->user();

                    if (! $user) {
                        return;
                    }

                    $status = Password::broker()->sendResetLink(
                        ['email' => $user->email]
                    );

                    if ($status === Password::RESET_LINK_SENT) {
                        \Filament\Notifications\Notification::make()->success()->title('Link Terkirim!')->send();
                    } else {
                        \Filament\Notifications\Notification::make()->danger()->title('Gagal mengirim link')->body(__($status))->send();
                    }
                }),
        ];
    }
}
