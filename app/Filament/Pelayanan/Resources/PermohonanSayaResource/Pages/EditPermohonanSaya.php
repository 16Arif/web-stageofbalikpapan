<?php

declare(strict_types=1);

namespace App\Filament\Pelayanan\Resources\PermohonanSayaResource\Pages;

use App\Filament\Pelayanan\Resources\PermohonanSayaResource;
use Filament\Resources\Pages\EditRecord;

class EditPermohonanSaya extends EditRecord
{
    protected static string $resource = PermohonanSayaResource::class;

    protected static ?string $title = 'Lengkapi Berkas Permohonan Data';

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
