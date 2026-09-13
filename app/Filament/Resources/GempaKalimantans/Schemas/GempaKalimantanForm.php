<?php

declare(strict_types=1);

namespace App\Filament\Resources\GempaKalimantans\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GempaKalimantanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Parameter Gempabumi')
                    ->description('Rincian parameter teknis kejadian gempabumi di wilayah Kalimantan.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                DateTimePicker::make('waktu_gempa')
                                    ->label('Waktu Kejadian (WIB)')
                                    ->native(false)
                                    ->required()
                                    ->helperText('Waktu kejadian gempabumi dalam zona WIB.'),

                                TextInput::make('magnitudo')
                                    ->label('Magnitudo')
                                    ->numeric()
                                    ->step(0.1)
                                    ->required()
                                    ->placeholder('Contoh: 4.2'),

                                TextInput::make('kedalaman')
                                    ->label('Kedalaman')
                                    ->required()
                                    ->placeholder('Contoh: 10 km'),

                                TextInput::make('koordinat')
                                    ->label('Koordinat')
                                    ->required()
                                    ->placeholder('Contoh: 1.92 LS - 116.12 BT'),
                            ]),

                        TextInput::make('wilayah')
                            ->label('Lokasi & Wilayah')
                            ->required()
                            ->placeholder('Contoh: 25 km Barat Daya PASER - KALTIM'),

                        Textarea::make('keterangan')
                            ->label('Keterangan Narasi Pusat Gempa')
                            ->placeholder('Contoh: Pusat Gempa Berada di Darat 25 km Barat Daya PASER')
                            ->rows(3)
                            ->helperText('Narasi deskriptif pusat gempabumi untuk tampilan kartu utama.'),
                    ])
                    ->columnSpan(2),

                Section::make('Peta & Publikasi')
                    ->description('Unggah peta kejadian gempa dan status tayang.')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('peta_gempa')
                            ->label('Peta Gempa')
                            ->collection('peta_gempa')
                            ->disk('public')
                            ->image()
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->helperText('Format: JPG, PNG, WEBP. Maksimal ukuran file 2MB.')
                            ->imageEditor()
                            ->validationMessages([
                                'max' => 'Ukuran gambar terlalu besar. Maksimal ukuran file adalah 2MB.',
                                'mimetypes' => 'Format file tidak valid. Harap unggah gambar JPG, PNG, atau WEBP.',
                            ]),

                        Toggle::make('is_active')
                            ->label('Publikasikan Data Gempa')
                            ->default(true)
                            ->helperText('Aktifkan untuk menayangkan data ini pada halaman web.'),
                    ])
                    ->columnSpan(1),
            ])
            ->columns(3);
    }
}
