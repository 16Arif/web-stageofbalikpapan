<?php

declare(strict_types=1);

namespace App\Filament\Resources\KelolaPermohonanResource\Pages;

use App\Filament\Resources\KelolaPermohonanResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewKelolaPermohonan extends ViewRecord
{
    protected static string $resource = KelolaPermohonanResource::class;

    protected static ?string $title = 'Rincian Permohonan Layanan';

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->label('Verifikasi / Update Status'),
        ];
    }
}
