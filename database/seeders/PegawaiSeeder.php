<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pegawais = [
            // KUPT
            [
                'nama' => 'Andi Azhar Rusdin, S.Si, M.Sc',
                'nip' => null,
                'jabatan' => 'Kepala Stasiun',
                'kategori' => Pegawai::KATEGORI_KUPT,
                'is_active' => true,
            ],

            // Sub Bagian Tata Usaha
            [
                'nama' => 'Ayun Lestari, S.E',
                'nip' => null,
                'jabatan' => 'Kepala Sub Bagian Tata Usaha',
                'kategori' => Pegawai::KATEGORI_TATA_USAHA,
                'is_active' => true,
            ],
            [
                'nama' => 'Nurgiantoro',
                'nip' => null,
                'jabatan' => null,
                'kategori' => Pegawai::KATEGORI_TATA_USAHA,
                'is_active' => true,
            ],
            [
                'nama' => 'Irena Damayanti, S.Kom',
                'nip' => null,
                'jabatan' => null,
                'kategori' => Pegawai::KATEGORI_TATA_USAHA,
                'is_active' => true,
            ],

            // Kelompok Jabatan Fungsional
            [
                'nama' => 'Usni Samosir, S.T',
                'nip' => null,
                'jabatan' => null,
                'kategori' => Pegawai::KATEGORI_FUNGSIONAL,
                'is_active' => true,
            ],
            [
                'nama' => 'Benny Hendrawanto, S.T',
                'nip' => null,
                'jabatan' => null,
                'kategori' => Pegawai::KATEGORI_FUNGSIONAL,
                'is_active' => true,
            ],
            [
                'nama' => 'Catur Sih Utami, S.Si',
                'nip' => null,
                'jabatan' => null,
                'kategori' => Pegawai::KATEGORI_FUNGSIONAL,
                'is_active' => true,
            ],
            [
                'nama' => 'Firmansyah, S.Kom',
                'nip' => null,
                'jabatan' => null,
                'kategori' => Pegawai::KATEGORI_FUNGSIONAL,
                'is_active' => true,
            ],
            [
                'nama' => 'Mohammad Sholeh, S.Tr.Geof',
                'nip' => null,
                'jabatan' => null,
                'kategori' => Pegawai::KATEGORI_FUNGSIONAL,
                'is_active' => true,
            ],
            [
                'nama' => 'Sucianty, S.Tr',
                'nip' => null,
                'jabatan' => null,
                'kategori' => Pegawai::KATEGORI_FUNGSIONAL,
                'is_active' => true,
            ],
            [
                'nama' => 'Nur Eka Deviyanti, S.Tr',
                'nip' => null,
                'jabatan' => null,
                'kategori' => Pegawai::KATEGORI_FUNGSIONAL,
                'is_active' => true,
            ],
            [
                'nama' => 'Muh. Alfatham Werdi P., S.Tr.Geof',
                'nip' => null,
                'jabatan' => null,
                'kategori' => Pegawai::KATEGORI_FUNGSIONAL,
                'is_active' => true,
            ],
            [
                'nama' => 'Nur Baiti Febryana S., S.Tr',
                'nip' => null,
                'jabatan' => null,
                'kategori' => Pegawai::KATEGORI_FUNGSIONAL,
                'is_active' => true,
            ],
            [
                'nama' => 'Abdul Arif, S.Tr.Inst',
                'nip' => null,
                'jabatan' => null,
                'kategori' => Pegawai::KATEGORI_FUNGSIONAL,
                'is_active' => true,
            ],
            [
                'nama' => 'Hadrian Dama Galib, S.Tr.Inst',
                'nip' => null,
                'jabatan' => null,
                'kategori' => Pegawai::KATEGORI_FUNGSIONAL,
                'is_active' => true,
            ],
            [
                'nama' => 'Ahmad N. Hidayat, S.Tr.Inst',
                'nip' => null,
                'jabatan' => null,
                'kategori' => Pegawai::KATEGORI_FUNGSIONAL,
                'is_active' => true,
            ],
            [
                'nama' => 'Imam Tanthawi Anfasa, S.Tr.Geof',
                'nip' => null,
                'jabatan' => null,
                'kategori' => Pegawai::KATEGORI_FUNGSIONAL,
                'is_active' => true,
            ],
            [
                'nama' => 'Nida Faiza, S.Tr.Geof',
                'nip' => null,
                'jabatan' => null,
                'kategori' => Pegawai::KATEGORI_FUNGSIONAL,
                'is_active' => true,
            ],
        ];

        foreach ($pegawais as $data) {
            Pegawai::updateOrCreate(
                ['nama' => $data['nama']],
                $data
            );
        }
    }
}
