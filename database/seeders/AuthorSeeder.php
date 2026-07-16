<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            'Humas Stageof Balikpapan',
            'Teknisi Stageof Balikpapan',
            'Operasional Stageof Balikpapan',
        ] as $name) {
            Author::query()->updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name],
            );
        }
    }
}
