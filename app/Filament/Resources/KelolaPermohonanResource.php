<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\KelolaPermohonanResource\Pages;
use App\Models\PermohonanLayanan;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class KelolaPermohonanResource extends Resource
{
    protected static ?string $model = PermohonanLayanan::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-inbox-stack';

    protected static \UnitEnum|string|null $navigationGroup = 'Geofisika';

    protected static ?string $navigationLabel = 'Kelola Permohonan Data';

    protected static ?string $modelLabel = 'Permohonan Layanan';

    protected static ?string $pluralModelLabel = 'Kelola Permohonan Data';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Identitas Pemohon')
                    ->description('Data profil pemohon yang terdaftar.')
                    ->schema([
                        \Filament\Forms\Components\Select::make('applicant_id')
                            ->relationship('applicant', 'name')
                            ->label('Nama Pemohon')
                            ->searchable()
                            ->preload()
                            ->disabled(),
                        \Filament\Forms\Components\TextInput::make('nomor_tiket')
                            ->label('Nomor Tiket Permohonan')
                            ->disabled(),
                    ])->columns(2),

                \Filament\Schemas\Components\Section::make('Rincian Kebutuhan Data')
                    ->description('Data dan spesifikasi teknis yang diminta oleh pemohon.')
                    ->schema([
                        \Filament\Forms\Components\Select::make('kategori_layanan')
                            ->label('Kategori Layanan')
                            ->options(PermohonanLayanan::getKategoriLayananOptions())
                            ->disabled(),
                        \Filament\Forms\Components\TextInput::make('judul_permohonan')
                            ->label('Judul Permohonan')
                            ->disabled(),
                        \Filament\Forms\Components\Select::make('tujuan_penggunaan')
                            ->label('Tujuan Penggunaan')
                            ->options(PermohonanLayanan::getTujuanPenggunaanOptions())
                            ->disabled(),
                        \Filament\Forms\Components\Select::make('tipe_tarif')
                            ->label('Tipe Tarif')
                            ->options(PermohonanLayanan::getTipeTarifOptions())
                            ->disabled(),
                        \Filament\Forms\Components\Textarea::make('rincian_kebutuhan')
                            ->label('Rincian Parameter & Kebutuhan Data')
                            ->disabled()
                            ->columnSpanFull()
                            ->rows(3),
                        \Filament\Forms\Components\FileUpload::make('berkas_permohonan')
                            ->label('Surat Permohonan Resmi (PDF)')
                            ->downloadable()
                            ->openable()
                            ->disabled(),
                        \Filament\Forms\Components\FileUpload::make('berkas_pendukung')
                            ->label('Dokumen Pendukung / KTM (PDF)')
                            ->downloadable()
                            ->openable()
                            ->disabled(),
                    ])->columns(2),

                \Filament\Schemas\Components\Section::make('Tindakan & Verifikasi Petugas BMKG')
                    ->description('Kelola status verifikasi, kode billing Simponi PNBP, dan unggah paket data hasil analisis.')
                    ->schema([
                        \Filament\Forms\Components\Select::make('status')
                            ->label('Status Permohonan')
                            ->options(PermohonanLayanan::getStatusOptions())
                            ->required()
                            ->native(false),
                        \Filament\Forms\Components\TextInput::make('kode_billing_simponi')
                            ->label('Kode Billing Simponi (Kemenkeu)')
                            ->placeholder('Masukkan nomor billing Simponi')
                            ->maxLength(50),
                        \Filament\Forms\Components\TextInput::make('nominal_pnbp')
                            ->label('Nominal Tarif PNBP')
                            ->numeric()
                            ->prefix('Rp'),
                        \Filament\Forms\Components\DateTimePicker::make('expired_billing_at')
                            ->label('Batas Waktu Bayar Billing Simponi'),
                        \Filament\Forms\Components\Textarea::make('catatan_petugas')
                            ->label('Catatan / Instruksi Petugas untuk Pemohon')
                            ->placeholder('Contoh: Berkas disetujui, silakan bayar billing Simponi sebelum batas waktu.')
                            ->columnSpanFull()
                            ->rows(3),
                        \Filament\Forms\Components\FileUpload::make('berkas_bukti_bayar')
                            ->label('Bukti Pembayaran dari Pemohon')
                            ->downloadable()
                            ->openable()
                            ->disabled(),
                        \Filament\Forms\Components\FileUpload::make('berkas_hasil_data')
                            ->label('Unggah Paket Data Resmi (ZIP/PDF/CSV/Excel)')
                            ->directory('permohonan/hasil-data')
                            ->maxSize(51200)
                            ->downloadable()
                            ->openable()
                            ->columnSpanFull()
                            ->helperText('Unggah arsip data resmi hasil ekstraksi sensor geofisika yang siap diunduh oleh pemohon.'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('nomor_tiket')
                    ->label('No. Tiket')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->copyable(),
                \Filament\Tables\Columns\TextColumn::make('applicant.name')
                    ->label('Pemohon')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('kategori_layanan')
                    ->label('Kategori')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        PermohonanLayanan::KATEGORI_GEMPABUMI => 'Gempabumi',
                        PermohonanLayanan::KATEGORI_PETIR => 'Petir',
                        PermohonanLayanan::KATEGORI_KONSULTASI => 'Konsultasi',
                        default => $state,
                    })
                    ->color('info'),
                \Filament\Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => PermohonanLayanan::getStatusOptions()[$state] ?? $state)
                    ->color(fn ($state) => PermohonanLayanan::getStatusColorMap()[$state] ?? 'gray'),
                \Filament\Tables\Columns\TextColumn::make('tipe_tarif')
                    ->label('Tarif')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        PermohonanLayanan::TARIF_NOL_RUPIAH => 'Rp 0,-',
                        PermohonanLayanan::TARIF_PNBP => 'PNBP',
                        default => $state,
                    }),
                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->label('Tgl Pengajuan')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options(PermohonanLayanan::getStatusOptions()),
                \Filament\Tables\Filters\SelectFilter::make('kategori_layanan')
                    ->label('Filter Kategori')
                    ->options(PermohonanLayanan::getKategoriLayananOptions()),
            ])
            ->actions([
                \Filament\Actions\ViewAction::make(),
                \Filament\Actions\EditAction::make()->label('Verifikasi / Update'),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKelolaPermohonans::route('/'),
            'view' => Pages\ViewKelolaPermohonan::route('/{record}'),
            'edit' => Pages\EditKelolaPermohonan::route('/{record}/edit'),
        ];
    }
}
