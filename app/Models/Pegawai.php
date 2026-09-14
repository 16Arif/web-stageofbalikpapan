<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Pegawai extends Model
{
    public const CACHE_KEY = 'struktur_organisasi_pegawai';

    public const KATEGORI_KUPT = 'kupt';

    public const KATEGORI_TATA_USAHA = 'tata_usaha';

    public const KATEGORI_FUNGSIONAL = 'fungsional';

    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'kategori',
        'is_active',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saved(function (): void {
            Cache::forget(self::CACHE_KEY);
        });

        static::deleted(function (): void {
            Cache::forget(self::CACHE_KEY);
        });
    }

    /**
     * @return array<string, string>
     */
    public static function getKategoriOptions(): array
    {
        return [
            self::KATEGORI_KUPT => 'Kepala Stasiun (KUPT)',
            self::KATEGORI_TATA_USAHA => 'Sub Bagian Tata Usaha',
            self::KATEGORI_FUNGSIONAL => 'Kelompok Jabatan Fungsional',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeKupt(Builder $query): Builder
    {
        return $query->where('kategori', self::KATEGORI_KUPT);
    }

    public function scopeTataUsaha(Builder $query): Builder
    {
        return $query->where('kategori', self::KATEGORI_TATA_USAHA);
    }

    public function scopeFungsional(Builder $query): Builder
    {
        return $query->where('kategori', self::KATEGORI_FUNGSIONAL);
    }

    public function scopeHierarchicalOrder(Builder $query): Builder
    {
        return $query
            ->orderByRaw('CASE WHEN jabatan IS NOT NULL AND jabatan != "" THEN 0 ELSE 1 END')
            ->orderByRaw('nip IS NULL, nip ASC')
            ->orderBy('nama', 'asc');
    }
}
