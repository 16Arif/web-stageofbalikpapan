<?php

declare(strict_types=1);

namespace App\Filament\Pelayanan\Resources\PermohonanSayaResource\Pages;

use App\Filament\Pelayanan\Resources\PermohonanSayaResource;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPermohonanSaya extends EditRecord
{
    protected static string $resource = PermohonanSayaResource::class;

    protected static ?string $title = 'Edit Permohonan Data';

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make()
                ->label('Lihat Detail'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
