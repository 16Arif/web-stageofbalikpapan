<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Berita>
 */
class BeritaFactory extends Factory
{
    public function definition(): array
    {
        $judul = fake('id_ID')->sentence(6);
        
        return [
            'judul' => rtrim($judul, '.'),
            'slug' => Str::slug($judul),
            'konten' => fake('id_ID')->paragraphs(5, true),
            'gambar_thumbnail' => null,
            'penulis' => fake('id_ID')->name(),
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
