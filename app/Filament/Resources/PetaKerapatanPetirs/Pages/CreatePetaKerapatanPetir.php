<?php

declare(strict_types=1);

namespace App\Filament\Resources\PetaKerapatanPetirs\Pages;

use App\Filament\Resources\PetaKerapatanPetirs\PetaKerapatanPetirResource;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreatePetaKerapatanPetir extends CreateRecord
{
    protected static string $resource = PetaKerapatanPetirResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()
            ->label('Simpan');
    }

    protected function getCreateAnotherFormAction(): Action
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
