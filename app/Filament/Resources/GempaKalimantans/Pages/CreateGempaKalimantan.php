<?php

declare(strict_types=1);

namespace App\Filament\Resources\GempaKalimantans\Pages;

use App\Filament\Resources\GempaKalimantans\GempaKalimantanResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateGempaKalimantan extends CreateRecord
{
    protected static string $resource = GempaKalimantanResource::class;

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
}
