<?php

declare(strict_types=1);

namespace App\Filament\Pelayanan\Widgets;

use App\Models\PermohonanLayanan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PermohonanStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $applicantId = auth('applicant')->id();

        $totalPermohonan = PermohonanLayanan::query()
            ->where('applicant_id', $applicantId)
            ->count();

        $dalamProses = PermohonanLayanan::query()
            ->where('applicant_id', $applicantId)
            ->whereIn('status', [
                PermohonanLayanan::STATUS_DIAJUKAN,
                PermohonanLayanan::STATUS_DIVERIFIKASI,
                PermohonanLayanan::STATUS_DIPROSES,
            ])
            ->count();

        $menungguPembayaran = PermohonanLayanan::query()
            ->where('applicant_id', $applicantId)
            ->where('status', PermohonanLayanan::STATUS_MENUNGGU_BAYAR)
            ->count();

        $selesaiSiapUnduh = PermohonanLayanan::query()
            ->where('applicant_id', $applicantId)
            ->where('status', PermohonanLayanan::STATUS_SELESAI)
            ->count();

        return [
            Stat::make('Total Pengajuan', (string) $totalPermohonan)
                ->description('Seluruh riwayat permohonan Anda')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),

            Stat::make('Dalam Proses', (string) $dalamProses)
                ->description('Sedang diverifikasi atau dianalisis petugas')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Menunggu Bayar', (string) $menungguPembayaran)
                ->description('Kode billing Simponi PNBP diterbitkan')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('danger'),

            Stat::make('Selesai / Siap Unduh', (string) $selesaiSiapUnduh)
                ->description('File data resmi BMKG siap diunduh')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),
        ];
    }
}
