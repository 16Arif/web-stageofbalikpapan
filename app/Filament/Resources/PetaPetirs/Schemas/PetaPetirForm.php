<?php

declare(strict_types=1);

namespace App\Filament\Resources\PetaPetirs\Schemas;

use Filament\Schemas\Schema;

class PetaPetirForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Group::make([
                    \Filament\Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                        ->label('Gambar Peta Petir')
                        ->collection('default')
                        ->disk('public')
                        ->image()
                        ->maxSize(2048)
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                        ->helperText('Format yang didukung: JPG, PNG, atau WEBP. Maksimal ukuran file: 2MB.')
                        ->imageEditor()
                        ->validationMessages([
                            'max' => 'Ukuran gambar terlalu besar. Maksimal ukuran file adalah 2MB.',
                            'mimetypes' => 'Format file tidak valid. Harap unggah gambar dengan format JPG, PNG, atau WEBP.',
                        ])
                        ->required(),
                ])->columnSpan(1),

                \Filament\Schemas\Components\Group::make([
                    \Filament\Forms\Components\Hidden::make('periode')
                        ->required(),

                    \Filament\Schemas\Components\Grid::make(2)
                        ->schema([
                            \Filament\Forms\Components\Select::make('bulan_input')
                                ->label('Bulan Peta')
                                ->options([
                                    '01' => 'Januari',
                                    '02' => 'Februari',
                                    '03' => 'Maret',
                                    '04' => 'April',
                                    '05' => 'Mei',
                                    '06' => 'Juni',
                                    '07' => 'Juli',
                                    '08' => 'Agustus',
                                    '09' => 'September',
                                    '10' => 'Oktober',
                                    '11' => 'November',
                                    '12' => 'Desember',
                                ])
                                ->dehydrated(false)
                                ->live()
                                ->afterStateHydrated(function (\Filament\Schemas\Components\Utilities\Get $get, \Filament\Schemas\Components\Utilities\Set $set, $state) {
                                    $periode = $get('periode');
                                    if ($periode) {
                                        $date = $periode instanceof \Carbon\Carbon ? $periode : \Carbon\Carbon::parse($periode);
                                        $set('bulan_input', $date->format('m'));
                                    }
                                })
                                ->afterStateUpdated(function (\Filament\Schemas\Components\Utilities\Get $get, \Filament\Schemas\Components\Utilities\Set $set) {
                                    $bulan = $get('bulan_input');
                                    $tahun = $get('tahun_input');
                                    if ($bulan && $tahun) {
                                        $set('periode', "{$tahun}-{$bulan}-01");
                                    }
                                })
                                ->required(),

                            \Filament\Forms\Components\Select::make('tahun_input')
                                ->label('Tahun Peta')
                                ->options(function () {
                                    $currentYear = (int) date('Y');
                                    $years = [];
                                    for ($y = $currentYear; $y <= $currentYear + 3; $y++) {
                                        $years[(string) $y] = (string) $y;
                                    }
                                    return $years;
                                })
                                ->dehydrated(false)
                                ->live()
                                ->afterStateHydrated(function (\Filament\Schemas\Components\Utilities\Get $get, \Filament\Schemas\Components\Utilities\Set $set, $state) {
                                    $periode = $get('periode');
                                    if ($periode) {
                                        $date = $periode instanceof \Carbon\Carbon ? $periode : \Carbon\Carbon::parse($periode);
                                        $set('tahun_input', $date->format('Y'));
                                    }
                                })
                                ->afterStateUpdated(function (\Filament\Schemas\Components\Utilities\Get $get, \Filament\Schemas\Components\Utilities\Set $set) {
                                    $bulan = $get('bulan_input');
                                    $tahun = $get('tahun_input');
                                    if ($bulan && $tahun) {
                                        $set('periode', "{$tahun}-{$bulan}-01");
                                    }
                                })
                                ->required(),
                        ]),

                    \Filament\Forms\Components\RichEditor::make('deskripsi')
                        ->label('Deskripsi Peta')
                        ->disableToolbarButtons([
                            'attachFiles',
                            'codeBlock',
                            'blockquote',
                        ]),

                    \Filament\Forms\Components\Toggle::make('is_active')
                        ->label('Publikasikan Peta')
                        ->helperText('Aktifkan untuk menerbitkan peta ke publik. Biarkan mati untuk menyimpan sebagai Draf.')
                        ->default(true)
                        ->required(),
                ])->columnSpan(1),
            ])
            ->columns(2);
    }
}
