<?php

declare(strict_types=1);

namespace App\Filament\Resources\KelolaPermohonanResource\Pages;

use App\Filament\Resources\KelolaPermohonanResource;
use Filament\Resources\Pages\EditRecord;

class EditKelolaPermohonan extends EditRecord
{
    protected static string $resource = KelolaPermohonanResource::class;

    protected static ?string $title = 'Verifikasi & Pemrosesan Permohonan Layanan';

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
