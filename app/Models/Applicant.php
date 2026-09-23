<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\ApplicantFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Applicant extends Authenticatable implements FilamentUser, HasName
{
    /** @use HasFactory<ApplicantFactory> */
    use HasFactory, Notifiable;

    /**
     * Nama tabel di database.
     *
     * @var string
     */
    protected $table = 'applicants';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'identity_number',
        'tipe_pemohon',
        'institution_name',
        'phone',
        'email',
        'password',
        'address',
        'is_active',
    ];

    /**
     * Atribut yang disembunyikan saat serialisasi.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting tipe atribut.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->is_active && $panel->getId() === 'pelayanan';
    }

    public function getFilamentName(): string
    {
        return $this->name;
    }

    public function permohonanLayanans(): HasMany
    {
        return $this->hasMany(PermohonanLayanan::class);
    }
}
