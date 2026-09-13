<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class GempaKalimantan extends Model implements HasMedia
{
    use InteractsWithMedia;

    public const CACHE_KEY = 'gempa_kalimantan_terkini_5';

    protected $table = 'gempa_kalimantans';

    protected $fillable = [
        'waktu_gempa',
        'magnitudo',
        'kedalaman',
        'wilayah',
        'keterangan',
        'koordinat',
        'is_active',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'waktu_gempa' => 'datetime',
            'is_active' => 'boolean',
            'magnitudo' => 'float',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('peta_gempa')
            ->useDisk('public')
            ->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('webp')
            ->format('webp')
            ->nonQueued();
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
     * Accessor untuk URL peta gempa (WebP versi konversi jika ada, atau gambar original).
     */
    protected function petaGempaUrl(): Attribute
    {
        return Attribute::make(
            get: function (): ?string {
                $url = $this->getFirstMediaUrl('peta_gempa', 'webp');

                if ($url !== '') {
                    return $url;
                }

                $originalUrl = $this->getFirstMediaUrl('peta_gempa');

                return $originalUrl !== '' ? $originalUrl : null;
            }
        );
    }

    /**
     * Accessor format tanggal (contoh: 15 Mei 2026).
     */
    protected function formattedDate(): Attribute
    {
        return Attribute::make(
            get: function (): ?string {
                return $this->waktu_gempa?->translatedFormat('d F Y');
            }
        );
    }

    /**
     * Accessor format jam WIB (contoh: 14:30:00 WIB).
     */
    protected function formattedTime(): Attribute
    {
        return Attribute::make(
            get: function (): ?string {
                return $this->waktu_gempa ? $this->waktu_gempa->format('H:i:s').' WIB' : null;
            }
        );
    }

    /**
     * Accessor format jam tanpa timezone untuk kolom tabel ringkas.
     */
    protected function formattedTimeOnly(): Attribute
    {
        return Attribute::make(
            get: function (): ?string {
                return $this->waktu_gempa?->format('H:i:s');
            }
        );
    }

    /**
     * Accessor format tanggal dan jam WIB.
     */
    protected function formattedDatetime(): Attribute
    {
        return Attribute::make(
            get: function (): ?string {
                if (! $this->waktu_gempa) {
                    return null;
                }

                return $this->waktu_gempa->translatedFormat('d F Y').' | '.$this->waktu_gempa->format('H:i:s').' WIB';
            }
        );
    }

    /**
     * Scope untuk data aktif.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk data terurut dari waktu terbaru.
     */
    public function scopeLatestEvent(Builder $query): Builder
    {
        return $query->orderBy('waktu_gempa', 'desc');
    }
}
