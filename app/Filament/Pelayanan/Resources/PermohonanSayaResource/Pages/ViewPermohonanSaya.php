<?php

declare(strict_types=1);

namespace App\Filament\Pelayanan\Resources\PermohonanSayaResource\Pages;

use App\Filament\Pelayanan\Resources\PermohonanSayaResource;
use App\Models\PermohonanLayanan;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPermohonanSaya extends ViewRecord
{
    protected static string $resource = PermohonanSayaResource::class;

    protected static ?string $title = 'Rincian Permohonan Data';

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->label('Lengkapi Berkas')
                ->visible(fn (PermohonanLayanan $record): bool => in_array($record->status, [
                    PermohonanLayanan::STATUS_DIAJUKAN,
                    PermohonanLayanan::STATUS_MENUNGGU_BAYAR,
                ])),
        ];
    }
}
