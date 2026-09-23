<?php

declare(strict_types=1);

namespace App\Filament\Pelayanan\Resources\PermohonanSayaResource\Pages;

use App\Filament\Pelayanan\Resources\PermohonanSayaResource;
use App\Models\PermohonanLayanan;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Storage;

class ViewPermohonanSaya extends ViewRecord
{
    protected static string $resource = PermohonanSayaResource::class;

    protected static ?string $title = 'Rincian Permohonan Data';

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->label('Edit Permohonan')
                ->visible(fn (PermohonanLayanan $record): bool => $record->status !== PermohonanLayanan::STATUS_SELESAI),
            Action::make('unduh_data')
                ->label('Unduh Data Hasil')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->visible(fn (PermohonanLayanan $record): bool => $record->status === PermohonanLayanan::STATUS_SELESAI && ! empty($record->berkas_hasil_data))
                ->action(function (PermohonanLayanan $record) {
                    return Storage::download($record->berkas_hasil_data);
                }),
        ];
    }
}
