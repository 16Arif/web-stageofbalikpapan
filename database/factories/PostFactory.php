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
        $category = Category::query()->inRandomOrder()->first();
        $author = Author::query()->inRandomOrder()->first();
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
        $publishedAt = $this->faker->dateTimeBetween('-6 months', 'now');

        return [
            'slug' => Str::slug($title),
            'title' => $title,
            'excerpt' => $this->faker->paragraph(),
            'category' => $category?->name ?? 'Edukasi',
            'author' => $author?->name ?? 'Humas Stageof Balikpapan',
            'category_id' => $category?->id,
            'author_id' => $author?->id,
            'date' => $publishedAt->format('Y-m-d'),
            'published_at' => $publishedAt,
            'img' => $this->faker->boolean(70)
                ? 'https://images.unsplash.com/photo-1512580770426-cbed71c40e94?q=80&w=1200'
                : null,
            'content' => implode("\n\n", $this->faker->paragraphs(4)),
        ];
    }
}
