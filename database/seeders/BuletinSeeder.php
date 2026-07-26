<?php

namespace Database\Seeders;

use App\Models\Buletin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BuletinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tahunList = [2024, 2025, 2026];
        $bulanList = range(1, 12);

        foreach ($tahunList as $tahun) {
            // Ambil 4 bulan acak untuk setiap tahun
            $randomMonths = array_rand(array_flip($bulanList), 4);

            foreach ($randomMonths as $bulan) {
                $title = "Buletin Geofisika Edisi Bulan $bulan Tahun $tahun";

                Buletin::create([
                    'title' => $title,
                    'slug' => Str::slug($title),
                    'file_path' => 'dummy/dummy-buletin.pdf',
                    'bulan' => $bulan,
                    'tahun' => $tahun,
                ]);
            }
        }
    }
}
