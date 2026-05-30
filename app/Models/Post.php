<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    public const STATUS_DRAFT = 'draft';

    public const STATUS_SCHEDULED = 'scheduled';

    public const STATUS_PUBLISHED = 'published';

    public const STATUS_ARCHIVED = 'archived';

    protected $fillable = [
        'slug',
        'status',
        'title',
        'excerpt',
        'category',
        'author',
        'category_id',
        'author_id',
        'date',
        'published_at',
        'img',
        'featured_image',
        'meta_title',
        'meta_description',
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

    public function isPublished(): bool
    {
        return $this->status === self::STATUS_PUBLISHED
            && $this->published_at !== null
            && ! $this->published_at->isFuture();
    }

    public function isDraft(): bool
    {
        return $this->status === self::STATUS_DRAFT;
    }

    public function isScheduled(): bool
    {
        return $this->status === self::STATUS_SCHEDULED
            && $this->published_at !== null
            && $this->published_at->isFuture();
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('status', self::STATUS_PUBLISHED)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function scopeLatestPublished(Builder $query): Builder
    {
        return $query->orderByDesc('published_at');
    }

    public function scopeForCategory(Builder $query, Category|string|null $category): Builder
    {
        if ($category instanceof Category) {
            return $query->where('category_id', $category->id);
        }

        if (blank($category)) {
            return $query;
        }

        return $query->where(function (Builder $query) use ($category) {
            $query
                ->whereHas('category', fn (Builder $query) => $query->where('slug', $category))
                ->orWhere('category', $category);
        });
    }

    public function scopeForAuthor(Builder $query, Author|string|null $author): Builder
    {
        if ($author instanceof Author) {
            return $query->where('author_id', $author->id);
        }

        if (blank($author)) {
            return $query;
        }

        return $query->where(function (Builder $query) use ($author) {
            $query
                ->whereHas('author', fn (Builder $query) => $query->where('slug', $author))
                ->orWhere('author', $author);
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function categoryRelation(): BelongsTo
    {
        return $this->category();
    }

    public function authorRelation(): BelongsTo
    {
        return $this->author();
    }

    public function getImageUrlAttribute(): string
    {
        $image = $this->featured_image ?: $this->img;

        if (blank($image)) {
            return asset('favicon.ico');
        }

        if (Str::startsWith($image, ['http://', 'https://'])) {
            return $image;
        }

        if (Str::startsWith($image, '/')) {
            return asset(ltrim($image, '/'));
        }

        if (Storage::disk('public')->exists($image)) {
            return Storage::disk('public')->url($image);
        }

        return asset($image);
    }
}
