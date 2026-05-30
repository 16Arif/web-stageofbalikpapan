<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $status = $this->faker->randomElement([
            'published', 'published', 'published', 'published', // 66% published
            'draft', // 16% draft
            'scheduled' // 16% scheduled
        ]);

        $publishedAt = match ($status) {
            'published' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'scheduled' => $this->faker->dateTimeBetween('now', '+1 month'),
            'draft' => null,
            default => null,
        };

        $category = Category::query()->inRandomOrder()->first() ?? Category::factory()->create();
        $author = Author::query()->inRandomOrder()->first() ?? Author::factory()->create();
        $titlePrefix = $this->faker->randomElement([
            'Kunjungan Edukasi',
            'Pemeliharaan Rutin',
            'Koordinasi Mitigasi',
            'Sosialisasi Literasi',
            'Peningkatan Layanan',
            'Monitoring Operasional',
        ]);
        $titleSuffix = $this->faker->unique()->sentence(3);
        $title = "{$titlePrefix} {$titleSuffix}";

        return [
            'slug' => Str::slug($title),
            'title' => $title,
            'excerpt' => $this->faker->paragraph(),
            'category' => $category->name,
            'author' => $author->name,
            'category_id' => $category->id,
            'author_id' => $author->id,
            'date' => $publishedAt?->format('Y-m-d'),
            'published_at' => $publishedAt,
            'status' => $status,
            'img' => $this->faker->boolean(70)
                ? 'https://images.unsplash.com/photo-1512580770426-cbed71c40e94?q=80&w=1200'
                : null,
            'content' => implode("\n\n", $this->faker->paragraphs(4)),
        ];
    }
}
