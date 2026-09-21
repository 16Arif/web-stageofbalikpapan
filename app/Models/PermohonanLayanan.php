<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PermohonanLayanan extends Model
{
    use HasFactory;

    protected $table = 'permohonan_layanans';

    public const string KATEGORI_GEMPABUMI = 'gempabumi';
    public const string KATEGORI_PETIR = 'petir';
    public const string KATEGORI_KONSULTASI = 'konsultasi';

    public const string STATUS_DIAJUKAN = 'diajukan';
    public const string STATUS_DIVERIFIKASI = 'diverifikasi';
    public const string STATUS_MENUNGGU_BAYAR = 'menunggu_pembayaran';
    public const string STATUS_DIPROSES = 'diproses';
    public const string STATUS_SELESAI = 'selesai';
    public const string STATUS_DITOLAK = 'ditolak';

    public const string TARIF_NOL_RUPIAH = 'tarif_nol_rupiah';
    public const string TARIF_PNBP = 'tarif_pnbp';

    protected $fillable = [
        'nomor_tiket',
        'applicant_id',
        'kategori_layanan',
        'judul_permohonan',
        'rincian_kebutuhan',
        'tujuan_penggunaan',
        'tipe_tarif',
        'berkas_permohonan',
        'berkas_pendukung',
        'status',
        'catatan_petugas',
        'kode_billing_simponi',
        'nominal_pnbp',
        'expired_billing_at',
        'berkas_bukti_bayar',
        'berkas_hasil_data',
    ];

    protected function casts(): array
    {
        return [
            'nominal_pnbp' => 'decimal:2',
            'expired_billing_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (PermohonanLayanan $model): void {
            if (empty($model->nomor_tiket)) {
                $prefix = 'REQ-GEO-' . now()->format('Ym') . '-';
                $lastRecord = static::query()
                    ->where('nomor_tiket', 'like', $prefix . '%')
                    ->latest('id')
                    ->first();

                $lastNumber = 0;
                if ($lastRecord && preg_match('/-(\d+)$/', $lastRecord->nomor_tiket, $matches)) {
                    $lastNumber = (int) $matches[1];
                }

                $model->nomor_tiket = $prefix . str_pad((string) ($lastNumber + 1), 4, '0', STR_PAD_LEFT);
            }
        });
    }

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(Applicant::class);
    }

    /**
     * @return array<string, string>
     */
    public static function getKategoriLayananOptions(): array
    {
        return [
            self::KATEGORI_GEMPABUMI => 'Data Gempabumi (Katalog, Shakemap, Waveform)',
            self::KATEGORI_PETIR => 'Data Sambaran Petir (Kerapatan & Titik Sambaran)',
            self::KATEGORI_KONSULTASI => 'Konsultasi Teknis & Kunjungan Edukasi Kebencanaan',
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function getTujuanPenggunaanOptions(): array
    {
        return [
            'penelitian_skripsi' => 'Penelitian Akademik / Skripsi / Tesis Mahasiswa',
            'konstruksi_infrastruktur' => 'Perencanaan Konstruksi / Rekayasa Sipil',
            'klaim_asuransi' => 'Klaim Asuransi Sambaran Petir / Kebencanaan',
            'mitigasi_kebijakan' => 'Mitigasi Bencana & Kajian Pemerintahan',
            'kegiatan_edukasi' => 'Studi Lapangan / Kunjungan Edukatif BMKG',
            'lainnya' => 'Keperluan Lainnya',
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function getTipeTarifOptions(): array
    {
        return [
            self::TARIF_NOL_RUPIAH => 'Tarif Rp 0,- (Fasilitas Khusus Riset Akademik & Kebencanaan)',
            self::TARIF_PNBP => 'Tarif PNBP Resmi (Sesuai PP RI No. 47 Tahun 2018)',
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function getStatusOptions(): array
    {
        return [
            self::STATUS_DIAJUKAN => 'Diajukan',
            self::STATUS_DIVERIFIKASI => 'Diverifikasi',
            self::STATUS_MENUNGGU_BAYAR => 'Menunggu Pembayaran',
            self::STATUS_DIPROSES => 'Sedang Diproses',
            self::STATUS_SELESAI => 'Selesai (Siap Unduh)',
            self::STATUS_DITOLAK => 'Ditolak',
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function getStatusColorMap(): array
    {
        return [
            self::STATUS_DIAJUKAN => 'warning',
            self::STATUS_DIVERIFIKASI => 'info',
            self::STATUS_MENUNGGU_BAYAR => 'danger',
            self::STATUS_DIPROSES => 'primary',
            self::STATUS_SELESAI => 'success',
            self::STATUS_DITOLAK => 'gray',
        ];
    }
}
