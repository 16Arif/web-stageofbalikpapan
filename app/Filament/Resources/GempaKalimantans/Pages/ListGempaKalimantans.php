<?php

declare(strict_types=1);

namespace App\Filament\Resources\GempaKalimantans\Pages;

use App\Filament\Resources\GempaKalimantans\GempaKalimantanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGempaKalimantans extends ListRecords
{
    protected static string $resource = GempaKalimantanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Data Gempa'),
        ];
    }
}
