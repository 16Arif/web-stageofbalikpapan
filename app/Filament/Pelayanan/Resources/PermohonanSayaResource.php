<?php

declare(strict_types=1);

namespace App\Filament\Pelayanan\Resources;

use App\Filament\Pelayanan\Resources\PermohonanSayaResource\Pages;
use App\Models\PermohonanLayanan;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class PermohonanSayaResource extends Resource
{
    protected static ?string $model = PermohonanLayanan::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-duplicate';

    protected static \UnitEnum|string|null $navigationGroup = null;

    protected static ?string $modelLabel = 'Permohonan Data';

    protected static ?string $pluralModelLabel = 'Permohonan Data Saya';

    protected static ?string $navigationLabel = 'Permohonan Saya';

    protected static ?int $navigationSort = 1;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('applicant_id', auth('applicant')->id());
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Informasi Kebutuhan Data')
                    ->description('Lengkapi rincian jenis layanan dan parameter data geofisika yang Anda butuhkan.')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('nomor_tiket')
                            ->label('Nomor Tiket')
                            ->disabled()
                            ->visible(fn (string $operation): bool => $operation !== 'create'),
                        \Filament\Forms\Components\Select::make('kategori_layanan')
                            ->label('Kategori Layanan')
                            ->options(PermohonanLayanan::getKategoriLayananOptions())
                            ->required()
                            ->native(false),
                        \Filament\Forms\Components\TextInput::make('judul_permohonan')
                            ->label('Judul Permohonan')
                            ->placeholder('Contoh: Permohonan Data Sambaran Petir Wilayah Balikpapan Tahun 2025')
                            ->required()
                            ->maxLength(255),
                        \Filament\Forms\Components\Select::make('tujuan_penggunaan')
                            ->label('Tujuan Penggunaan Data')
                            ->options(PermohonanLayanan::getTujuanPenggunaanOptions())
                            ->required()
                            ->native(false),
                        \Filament\Forms\Components\Select::make('tipe_tarif')
                            ->label('Tipe Tarif')
                            ->options(PermohonanLayanan::getTipeTarifOptions())
                            ->default(PermohonanLayanan::TARIF_NOL_RUPIAH)
                            ->required()
                            ->helperText('Tarif Rp 0,- khusus untuk riset skripsi/tesis mahasiswa dan penanggulangan bencana (wajib melampirkan surat pengantar/KTM).')
                            ->native(false),
                        \Filament\Forms\Components\Textarea::make('rincian_kebutuhan')
                            ->label('Rincian Kebutuhan Data (Spesifikasi Teknis)')
                            ->placeholder('Sebutkan rentang tanggal data, koordinat/wilayah, serta format output data yang diharapkan.')
                            ->rows(4)
                            ->required(),
                    ]),

                \Filament\Schemas\Components\Section::make('Unggah Berkas Persyaratan')
                    ->description('Unggah dokumen pendukung resmi dalam format PDF.')
                    ->schema([
                        \Filament\Forms\Components\FileUpload::make('berkas_permohonan')
                            ->label('Surat Permohonan Resmi (PDF)')
                            ->directory('permohonan/surat')
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(5120)
                            ->helperText('Surat permohonan resmi ber-kop dan bertanda tangan yang ditujukan kepada Kepala Stasiun Geofisika Balikpapan (Maks. 5MB).'),
                        \Filament\Forms\Components\FileUpload::make('berkas_pendukung')
                            ->label('Dokumen Pendukung / KTM / Proposal (PDF)')
                            ->directory('permohonan/pendukung')
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(5120)
                            ->helperText('Wajib bagi pemohon fasilitas tarif Rp 0,-: lampirkan Kartu Tanda Mahasiswa (KTM) atau surat rekomendasi kampus.'),
                    ]),

                \Filament\Schemas\Components\Section::make('Status Verifikasi & Pembayaran (Simponi BMKG)')
                    ->description('Bagian ini diverifikasi langsung oleh petugas pelayanan Stasiun Geofisika Balikpapan.')
                    ->visible(fn (string $operation): bool => $operation !== 'create')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('status')
                            ->label('Status Saat Ini')
                            ->formatStateUsing(fn ($state) => PermohonanLayanan::getStatusOptions()[$state] ?? $state)
                            ->disabled(),
                        \Filament\Forms\Components\Textarea::make('catatan_petugas')
                            ->label('Catatan dari Petugas BMKG')
                            ->disabled()
                            ->rows(3),
                        \Filament\Forms\Components\TextInput::make('kode_billing_simponi')
                            ->label('Kode Billing Simponi (Kemenkeu)')
                            ->disabled()
                            ->helperText('Gunakan kode billing ini untuk pembayaran PNBP kas negara melalui ATM, M-Banking, atau Teller.'),
                        \Filament\Forms\Components\TextInput::make('nominal_pnbp')
                            ->label('Nominal Tarif PNBP')
                            ->prefix('Rp')
                            ->disabled(),
                        \Filament\Forms\Components\DateTimePicker::make('expired_billing_at')
                            ->label('Batas Waktu Bayar Billing')
                            ->disabled(),
                        \Filament\Forms\Components\FileUpload::make('berkas_bukti_bayar')
                            ->label('Unggah Bukti Setor / Pembayaran Simponi')
                            ->directory('permohonan/pembayaran')
                            ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                            ->maxSize(5120)
                            ->helperText('Unggah foto/struk bukti transaksi pembayaran setelah melunasi tagihan Simponi.'),
                        \Filament\Forms\Components\FileUpload::make('berkas_hasil_data')
                            ->label('File Data Resmi dari BMKG')
                            ->disabled()
                            ->helperText('Petugas akan mengunggah paket data geofisika resmi di sini setelah permohonan selesai diproses.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('nomor_tiket')
                    ->label('Nomor Tiket')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->copyable()
                    ->copyMessage('Nomor tiket berhasil disalin'),
                \Filament\Tables\Columns\TextColumn::make('judul_permohonan')
                    ->label('Judul Permohonan')
                    ->searchable()
                    ->limit(35),
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
                \Filament\Tables\Columns\TextColumn::make('tipe_tarif')
                    ->label('Tarif')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        PermohonanLayanan::TARIF_NOL_RUPIAH => 'Rp 0,-',
                        PermohonanLayanan::TARIF_PNBP => 'PNBP',
                        default => $state,
                    })
                    ->color(fn ($state) => $state === PermohonanLayanan::TARIF_NOL_RUPIAH ? 'success' : 'warning'),
                \Filament\Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => PermohonanLayanan::getStatusOptions()[$state] ?? $state)
                    ->color(fn ($state) => PermohonanLayanan::getStatusColorMap()[$state] ?? 'gray'),
                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Pengajuan')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([])
            ->actions([
                \Filament\Actions\ViewAction::make(),
                \Filament\Actions\EditAction::make()
                    ->label('Lengkapi Berkas')
                    ->visible(fn (PermohonanLayanan $record): bool => in_array($record->status, [
                        PermohonanLayanan::STATUS_DIAJUKAN,
                        PermohonanLayanan::STATUS_MENUNGGU_BAYAR,
                    ])),
                \Filament\Actions\Action::make('unduh_data')
                    ->label('Unduh Data')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->visible(fn (PermohonanLayanan $record): bool => $record->status === PermohonanLayanan::STATUS_SELESAI && ! empty($record->berkas_hasil_data))
                    ->action(function (PermohonanLayanan $record) {
                        return Storage::download($record->berkas_hasil_data);
                    }),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPermohonanSayas::route('/'),
            'create' => Pages\CreatePermohonanSaya::route('/create'),
            'view' => Pages\ViewPermohonanSaya::route('/{record}'),
            'edit' => Pages\EditPermohonanSaya::route('/{record}/edit'),
        ];
    }
}
