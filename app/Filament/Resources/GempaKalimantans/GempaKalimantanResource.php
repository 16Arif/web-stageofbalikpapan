<?php

declare(strict_types=1);

namespace App\Filament\Resources\GempaKalimantans;

use App\Filament\Resources\GempaKalimantans\Pages\CreateGempaKalimantan;
use App\Filament\Resources\GempaKalimantans\Pages\EditGempaKalimantan;
use App\Filament\Resources\GempaKalimantans\Pages\ListGempaKalimantans;
use App\Filament\Resources\GempaKalimantans\Schemas\GempaKalimantanForm;
use App\Filament\Resources\GempaKalimantans\Tables\GempaKalimantansTable;
use App\Models\GempaKalimantan;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class GempaKalimantanResource extends Resource
{
    protected static ?string $model = GempaKalimantan::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-globe-americas';

    protected static \UnitEnum|string|null $navigationGroup = 'Gempabumi';

    protected static ?string $modelLabel = 'Gempa Kalimantan';

    protected static ?string $pluralModelLabel = 'Daftar Gempa Kalimantan';

    protected static ?string $navigationLabel = 'Gempa Kalimantan';

    public static function form(Schema $schema): Schema
    {
        return GempaKalimantanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GempaKalimantansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGempaKalimantans::route('/'),
            'create' => CreateGempaKalimantan::route('/create'),
            'edit' => EditGempaKalimantan::route('/{record}/edit'),
        ];
    }
}
