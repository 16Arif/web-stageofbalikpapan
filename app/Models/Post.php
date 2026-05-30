<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'excerpt',
        'category',
        'author',
        'category_id',
        'author_id',
        'date',
        'published_at',
        'img',
        'content',
    ];

    protected $casts = [
        'date' => 'date',
        'published_at' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function categoryRelation()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function authorRelation()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function getImageUrlAttribute(): string
    {
        return $this->img ?: 'https://images.unsplash.com/photo-1512580770426-cbed71c40e94?q=80&w=1200';
    }
}
