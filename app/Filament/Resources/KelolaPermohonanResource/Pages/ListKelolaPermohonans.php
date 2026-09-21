<?php

declare(strict_types=1);

namespace App\Filament\Resources\KelolaPermohonanResource\Pages;

use App\Filament\Resources\KelolaPermohonanResource;
use Filament\Resources\Pages\ListRecords;

class ListKelolaPermohonans extends ListRecords
{
    protected static string $resource = KelolaPermohonanResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
