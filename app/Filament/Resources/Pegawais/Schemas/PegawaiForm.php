<?php

declare(strict_types=1);

namespace App\Filament\Resources\Pegawais\Schemas;

use App\Models\Pegawai;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PegawaiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pegawai')
                    ->schema([
                        TextInput::make('nama')
                            ->label('Nama Lengkap & Gelar')
                            ->placeholder('Contoh: Andi Azhar Rusdin, S.Si, M.Sc')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('nip')
                            ->label('NIP (Nomor Induk Pegawai)')
                            ->placeholder('Contoh: 19XXXXXXXXXXXXXX')
                            ->maxLength(50),

                        TextInput::make('jabatan')
                            ->label('Jabatan')
                            ->placeholder('Contoh: Kepala Sub Bagian Tata Usaha')
                            ->maxLength(255),

                        Select::make('kategori')
                            ->label('Kategori / Kelompok')
                            ->options(Pegawai::getKategoriOptions())
                            ->required()
                            ->default(Pegawai::KATEGORI_FUNGSIONAL)
                            ->native(false),

                        Toggle::make('is_active')
                            ->label('Tampilkan di Website')
                            ->helperText('Aktifkan agar pegawai ini tampil di halaman Struktur Organisasi.')
                            ->default(true)
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }
}
