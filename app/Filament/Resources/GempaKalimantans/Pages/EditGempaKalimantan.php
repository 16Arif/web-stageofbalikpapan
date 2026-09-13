<?php

declare(strict_types=1);

namespace App\Filament\Resources\GempaKalimantans\Pages;

use App\Filament\Resources\GempaKalimantans\GempaKalimantanResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGempaKalimantan extends EditRecord
{
    protected static string $resource = GempaKalimantanResource::class;

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
}
