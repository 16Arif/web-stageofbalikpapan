<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\BeritaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    /** @use HasFactory<BeritaFactory> */
    use HasFactory;

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

    public function incrementViews(): void
    {
        $sessionKey = 'viewed_berita_'.$this->id;
        if (! session()->has($sessionKey)) {
            $this->increment('views_count');
            session()->put($sessionKey, true);
        }
    }
}
