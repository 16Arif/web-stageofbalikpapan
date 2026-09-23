<?php

declare(strict_types=1);

namespace App\Filament\Pelayanan\Pages;

use Filament\Pages\Page;

class KatalogLayanan extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-squares-2x2';

    protected static \UnitEnum|string|null $navigationGroup = null;

    protected static ?string $navigationLabel = 'Katalog Layanan';

    protected static ?string $title = 'Katalog Layanan Data Geofisika';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pelayanan.pages.katalog-layanan';
}
