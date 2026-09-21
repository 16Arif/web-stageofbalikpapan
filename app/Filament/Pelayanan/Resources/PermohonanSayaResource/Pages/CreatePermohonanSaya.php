<?php

declare(strict_types=1);

namespace App\Filament\Pelayanan\Resources\PermohonanSayaResource\Pages;

use App\Filament\Pelayanan\Resources\PermohonanSayaResource;
use App\Models\PermohonanLayanan;
use Filament\Resources\Pages\CreateRecord;

class CreatePermohonanSaya extends CreateRecord
{
    protected static string $resource = PermohonanSayaResource::class;

    protected static ?string $title = 'Ajukan Permohonan Data Geofisika';

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
