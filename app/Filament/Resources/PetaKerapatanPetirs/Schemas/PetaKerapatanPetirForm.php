<?php

declare(strict_types=1);

namespace App\Filament\Resources\PetaKerapatanPetirs\Schemas;

use Carbon\Carbon;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class PetaKerapatanPetirForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make([
                    SpatieMediaLibraryFileUpload::make('image')
                        ->label('Gambar Peta Kerapatan Petir')
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

                Group::make([
                    Hidden::make('periode')
                        ->required(),

                    Grid::make(2)
                        ->schema([
                            Select::make('bulan_input')
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
                                ->afterStateHydrated(function (Get $get, Set $set, $state) {
                                    $periode = $get('periode');
                                    if ($periode) {
                                        $date = Carbon::parse($periode)->setTimezone(config('app.timezone'));
                                        $set('bulan_input', $date->format('m'));
                                    }
                                })
                                ->afterStateUpdated(function (Get $get, Set $set) {
                                    $bulan = $get('bulan_input');
                                    $tahun = $get('tahun_input');
                                    if ($bulan && $tahun) {
                                        $set('periode', "{$tahun}-{$bulan}-01");
                                    }
                                })
                                ->required(),

                            Select::make('tahun_input')
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
                                ->afterStateHydrated(function (Get $get, Set $set, $state) {
                                    $periode = $get('periode');
                                    if ($periode) {
                                        $date = Carbon::parse($periode)->setTimezone(config('app.timezone'));
                                        $set('tahun_input', $date->format('Y'));
                                    }
                                })
                                ->afterStateUpdated(function (Get $get, Set $set) {
                                    $bulan = $get('bulan_input');
                                    $tahun = $get('tahun_input');
                                    if ($bulan && $tahun) {
                                        $set('periode', "{$tahun}-{$bulan}-01");
                                    }
                                })
                                ->required(),
                        ]),

                    RichEditor::make('deskripsi')
                        ->label('Deskripsi Peta')
                        ->disableToolbarButtons([
                            'attachFiles',
                            'codeBlock',
                            'blockquote',
                        ]),

                    Toggle::make('is_active')
                        ->label('Publikasikan Peta')
                        ->helperText('Aktifkan untuk menerbitkan peta ke publik. Biarkan mati untuk menyimpan sebagai Draf.')
                        ->default(true)
                        ->required(),
                ])->columnSpan(1),
            ])
            ->columns(2);
    }
}
