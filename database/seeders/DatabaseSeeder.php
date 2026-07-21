<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::query()->updateOrCreate(
            ['email' => 'arif.abdul0002@gmail.com'],
            [
                'name' => 'arif',
                'password' => '12345678',
            ],
        );

        $this->call([
            BeritaSeeder::class,
        ]);
    }
}
