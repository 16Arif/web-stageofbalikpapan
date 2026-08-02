<?php

declare(strict_types=1);

namespace App\Filament\Resources\PetaPetirs\Pages;

use App\Filament\Resources\PetaPetirs\PetaPetirResource;
use Carbon\Carbon;
use Filament\Resources\Pages\CreateRecord;

class CreatePetaPetir extends CreateRecord
{
    protected static string $resource = PetaPetirResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreateFormAction(): \Filament\Actions\Action
    {
        return parent::getCreateFormAction()
            ->label('Simpan');
    }

    protected function getCreateAnotherFormAction(): \Filament\Actions\Action
    {
        return parent::getCreateAnotherFormAction()
            ->label('Simpan & Buat Lainnya');
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (isset($data['periode'])) {
            $data['periode'] = Carbon::parse($data['periode'])->startOfMonth()->format('Y-m-d');
        }

        return $data;
    }
}
