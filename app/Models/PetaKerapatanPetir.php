<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PetaKerapatanPetir extends Model implements HasMedia
{
    use InteractsWithMedia;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('default')
            ->useDisk('public')
            ->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('webp')
            ->format('webp')
            ->nonQueued();
    }

    protected $table = 'peta_kerapatan_petirs';

    protected $fillable = [
        'periode',
        'deskripsi',
        'is_active',
    ];

    protected $casts = [
        'periode' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Accessor untuk mendapatkan URL gambar pertama dari Spatie Media Library.
     */
    protected function mapImageUrl(): Attribute
    {
        return Attribute::make(
            get: function (): ?string {
                // 1. Coba ambil URL versi WebP hasil konversi
                $url = $this->getFirstMediaUrl('default', 'webp');

                if ($url !== '') {
                    return $url;
                }

                // 2. Fallback ke URL gambar original jika konversi WebP belum tersedia
                $originalUrl = $this->getFirstMediaUrl('default');

                return $originalUrl !== '' ? $originalUrl : null;
            }
        );
    }

    /**
     * Accessor untuk mendapatkan format teks periode bulan dan tahun yang mudah dibaca (e.g. "Agustus 2026").
     */
    protected function periodeBulanTahun(): Attribute
    {
        return Attribute::make(
            get: function (): ?string {
                if (! $this->periode) {
                    return null;
                }

                return $this->periode->translatedFormat('F Y');
            }
        );
    }
}
