<?php

declare(strict_types=1);

namespace App\Filament\Resources\PetaKerapatanPetirs\Pages;

use App\Filament\Resources\PetaKerapatanPetirs\PetaKerapatanPetirResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPetaKerapatanPetirs extends ListRecords
{
    protected static string $resource = PetaKerapatanPetirResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
