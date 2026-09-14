<?php

declare(strict_types=1);

namespace App\Filament\Resources\PetaPetirs\Pages;

use App\Filament\Resources\PetaPetirs\PetaPetirResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPetaPetirs extends ListRecords
{
    protected static string $resource = PetaPetirResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
