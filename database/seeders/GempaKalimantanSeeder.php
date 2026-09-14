<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\GempaKalimantan;
use Illuminate\Database\Seeder;

class GempaKalimantanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'waktu_gempa' => '2026-05-15 13:30:00',
                'magnitudo' => 4.2,
                'kedalaman' => '10 km',
                'wilayah' => '25 km Barat Daya PASER - KALTIM',
                'keterangan' => 'Pusat Gempa Berada di Darat 25 km Barat Daya PASER',
                'koordinat' => '1.92 LS - 116.12 BT',
                'is_active' => true,
            ],
            [
                'waktu_gempa' => '2026-05-10 07:15:22',
                'magnitudo' => 3.5,
                'kedalaman' => '5 km',
                'wilayah' => '40 km Timur Laut MAHAKAM ULU - KALTIM',
                'keterangan' => 'Pusat Gempa Berada di Darat 40 km Timur Laut MAHAKAM ULU',
                'koordinat' => '0.85 LU - 115.65 BT',
                'is_active' => true,
            ],
            [
                'waktu_gempa' => '2026-05-02 21:10:05',
                'magnitudo' => 4.0,
                'kedalaman' => '12 km',
                'wilayah' => '15 km Tenggara TABALONG - KALSEL',
                'keterangan' => 'Pusat Gempa Berada di Darat 15 km Tenggara TABALONG',
                'koordinat' => '2.15 LS - 115.42 BT',
                'is_active' => true,
            ],
            [
                'waktu_gempa' => '2026-04-24 16:45:10',
                'magnitudo' => 3.8,
                'kedalaman' => '10 km',
                'wilayah' => '32 km Timur Laut SANGATTA - KALTIM',
                'keterangan' => 'Pusat Gempa Berada di Laut 32 km Timur Laut SANGATTA',
                'koordinat' => '0.72 LU - 117.80 BT',
                'is_active' => true,
            ],
            [
                'waktu_gempa' => '2026-04-18 11:20:40',
                'magnitudo' => 4.4,
                'kedalaman' => '10 km',
                'wilayah' => '48 km Tenggara BERAU - KALTIM',
                'keterangan' => 'Pusat Gempa Berada di Laut 48 km Tenggara BERAU',
                'koordinat' => '2.10 LU - 117.95 BT',
                'is_active' => true,
            ],
        ];

        foreach ($data as $item) {
            GempaKalimantan::updateOrCreate(
                [
                    'waktu_gempa' => $item['waktu_gempa'],
                    'koordinat' => $item['koordinat'],
                ],
                $item
            );
        }
    }
}
