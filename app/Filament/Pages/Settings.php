<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Settings extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected string $view = 'filament.pages.settings';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Pengaturan';
}
