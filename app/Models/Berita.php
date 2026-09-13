<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\BeritaFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Berita extends Model implements HasMedia
{
    /** @use HasFactory<BeritaFactory> */
    use HasFactory;

    use InteractsWithMedia;

    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'gambar_thumbnail',
        'penulis',
        'published_at',
        'is_publish',
        'views_count',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'is_publish' => 'boolean',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_publish', true)->whereNotNull('published_at');
    }

    protected static function booted(): void
    {
        static::saved(function (): void {
            Cache::forget('home_latest_berita');
        });

        static::deleted(function (): void {
            Cache::forget('home_latest_berita');
        });
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('thumbnail')
            ->useDisk('public')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('optimized')
            ->format('webp')
            ->quality(80)
            ->nonOptimized();
    }

    /**
     * Accessor untuk mendapatkan URL thumbnail.
     * Prioritas: Spatie Media Library -> Kolom legacy gambar_thumbnail -> null.
     */
    public function getThumbnailUrlAttribute(): ?string
    {
        // 1. Coba ambil URL versi optimized (WebP)
        $spatieUrl = $this->getFirstMediaUrl('thumbnail', 'optimized');

        if ($spatieUrl !== '') {
            return $spatieUrl;
        }

        // 2. Fallback ke media original jika optimized belum selesai di-generate (misal dalam queue)
        $originalSpatieUrl = $this->getFirstMediaUrl('thumbnail');

        if ($originalSpatieUrl !== '') {
            return $originalSpatieUrl;
        }

        // 3. Fallback ke kolom legacy database untuk data berita lama
        if ($this->gambar_thumbnail) {
            return asset('storage/'.$this->gambar_thumbnail);
        }

        return null;
    }

    public function incrementViews(): void
    {
        $sessionKey = 'viewed_berita_'.$this->id;
        if (! session()->has($sessionKey)) {
            $this->increment('views_count');
            session()->put($sessionKey, true);
        }
    }
}
