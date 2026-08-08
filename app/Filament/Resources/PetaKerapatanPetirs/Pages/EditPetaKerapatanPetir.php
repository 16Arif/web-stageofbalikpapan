<?php

declare(strict_types=1);

namespace App\Filament\Resources\PetaKerapatanPetirs\Pages;

use App\Filament\Resources\PetaKerapatanPetirs\PetaKerapatanPetirResource;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPetaKerapatanPetir extends EditRecord
{
    protected static string $resource = PetaKerapatanPetirResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSaveFormAction(): Action
    {
        return parent::getSaveFormAction()
            ->label('Simpan');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['periode'])) {
            $data['periode'] = Carbon::parse($data['periode'])->startOfMonth()->format('Y-m-d');
        }

        return $data;
    }
}
