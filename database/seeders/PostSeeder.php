<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (!app()->isProduction()) {
            Post::query()->delete();
        }

        Post::factory()->count(15)->create();
    }
}
