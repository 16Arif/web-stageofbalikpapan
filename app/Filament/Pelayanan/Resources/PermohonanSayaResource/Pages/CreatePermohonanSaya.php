<?php

declare(strict_types=1);

namespace App\Filament\Pelayanan\Resources\PermohonanSayaResource\Pages;

use App\Filament\Pelayanan\Resources\PermohonanSayaResource;
use App\Models\PermohonanLayanan;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\HasWizard;

class CreatePermohonanSaya extends CreateRecord
{
    use HasWizard;

    protected static string $resource = PermohonanSayaResource::class;

    protected static ?string $title = 'Formulir Pengajuan Permohonan Data Geofisika';

    public function mount(): void
    {
        parent::mount();

        $kategori = request()->query('kategori');
        $layanan = request()->query('layanan');
        $tarif = request()->query('tarif');
        $tujuan = request()->query('tujuan');

        $updates = [];

        if ($kategori && in_array($kategori, [
            PermohonanLayanan::KATEGORI_GEMPABUMI,
            PermohonanLayanan::KATEGORI_PETIR,
            PermohonanLayanan::KATEGORI_KONSULTASI,
        ], true)) {
            $updates['kategori_layanan'] = $kategori;
        }

        if ($layanan) {
            $updates['judul_permohonan'] = 'Permohonan ' . $layanan;
        }

        if ($tarif && in_array($tarif, [
            PermohonanLayanan::TARIF_NOL_RUPIAH,
            PermohonanLayanan::TARIF_PNBP,
        ], true)) {
            $updates['tipe_tarif'] = $tarif;
        }

        if ($tujuan) {
            $updates['tujuan_penggunaan'] = $tujuan;
        }

        if (! empty($updates)) {
            $this->form->fill(array_merge($this->form->getState(), $updates));
        }
    }

    public function getSteps(): array
    {
        return [
            \Filament\Schemas\Components\Wizard\Step::make('Layanan & Tujuan')
                ->description('Pilih kategori dan tentukan tujuan penggunaan data')
                ->icon('heroicon-o-tag')
                ->schema([
                    \Filament\Forms\Components\Select::make('kategori_layanan')
                        ->label('Kategori Layanan')
                        ->options(PermohonanLayanan::getKategoriLayananOptions())
                        ->default(fn () => request()->query('kategori'))
                        ->required()
                        ->native(false)
                        ->helperText('Pilih salah satu bidang layanan data geofisika.'),

                    \Filament\Forms\Components\TextInput::make('judul_permohonan')
                        ->label('Judul Permohonan')
                        ->placeholder('Contoh: Permohonan Data Sambaran Petir Kota Balikpapan 2025')
                        ->default(fn () => request()->query('layanan') ? 'Permohonan ' . request()->query('layanan') : null)
                        ->required()
                        ->maxLength(255)
                        ->helperText('Berikan judul ringkas yang mencerminkan kebutuhan data Anda.'),

                    \Filament\Forms\Components\Select::make('tujuan_penggunaan')
                        ->label('Tujuan Penggunaan Data')
                        ->options(PermohonanLayanan::getTujuanPenggunaanOptions())
                        ->default(fn () => request()->query('tujuan'))
                        ->required()
                        ->native(false)
                        ->helperText('Tujuan penggunaan menentukan persyaratan kelengkapan dokumen pendukung.'),
                ]),

            \Filament\Schemas\Components\Wizard\Step::make('Rincian Kebutuhan & Tarif')
                ->description('Spesifikasi teknis parameter dan skema tarif PNBP')
                ->icon('heroicon-o-clipboard-document-list')
                ->schema([
                    \Filament\Forms\Components\Select::make('tipe_tarif')
                        ->label('Skema Tarif')
                        ->options(PermohonanLayanan::getTipeTarifOptions())
                        ->default(fn () => request()->query('tarif') ?? PermohonanLayanan::TARIF_NOL_RUPIAH)
                        ->required()
                        ->native(false)
                        ->helperText('Fasilitas Tarif Rp 0,- khusus untuk riset skripsi/tesis mahasiswa dan kegiatan kebencanaan (wajib melampirkan surat pengantar kampus / KTM).'),

                    \Filament\Forms\Components\Textarea::make('rincian_kebutuhan')
                        ->label('Rincian Kebutuhan Data (Spesifikasi Teknis)')
                        ->placeholder('Sebutkan rentang tanggal/periode data, koordinat/wilayah kajian, jenis parameter spesifik, serta format output data yang diharapkan.')
                        ->rows(5)
                        ->required()
                        ->helperText('Jelaskan parameter data secara rinci agar petugas Stasiun Geofisika Balikpapan dapat menyiapkan data dengan tepat.'),
                ]),

            \Filament\Schemas\Components\Wizard\Step::make('Unggah Dokumen Persyaratan')
                ->description('Lampirkan surat permohonan resmi dan berkas pendukung')
                ->icon('heroicon-o-document-arrow-up')
                ->schema([
                    \Filament\Forms\Components\FileUpload::make('berkas_permohonan')
                        ->label('Surat Permohonan Resmi (PDF)')
                        ->directory('permohonan/surat')
                        ->acceptedFileTypes(['application/pdf'])
                        ->maxSize(5120)
                        ->downloadable()
                        ->openable()
                        ->helperText('Surat permohonan resmi bertanda tangan dan ber-kop yang ditujukan kepada Kepala Stasiun Geofisika Balikpapan (Maks. 5MB).'),

                    \Filament\Forms\Components\FileUpload::make('berkas_pendukung')
                        ->label('Dokumen Pendukung / KTM / Proposal (PDF)')
                        ->directory('permohonan/pendukung')
                        ->acceptedFileTypes(['application/pdf'])
                        ->maxSize(5120)
                        ->downloadable()
                        ->openable()
                        ->helperText('Wajib bagi pemohon fasilitas tarif Rp 0,-: lampirkan Kartu Tanda Mahasiswa (KTM) atau surat rekomendasi kampus / proposal penelitian.'),
                ]),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['applicant_id'] = auth('applicant')->id();
        $data['status'] = PermohonanLayanan::STATUS_DIAJUKAN;

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
