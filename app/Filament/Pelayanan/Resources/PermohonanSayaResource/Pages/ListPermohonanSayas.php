<?php

declare(strict_types=1);

namespace App\Filament\Pelayanan\Resources\PermohonanSayaResource\Pages;

use App\Filament\Pelayanan\Resources\PermohonanSayaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPermohonanSayas extends ListRecords
{
    protected static string $resource = PermohonanSayaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Ajukan Permohonan Baru')
                ->icon('heroicon-o-plus-circle'),
        ];
    }
}
