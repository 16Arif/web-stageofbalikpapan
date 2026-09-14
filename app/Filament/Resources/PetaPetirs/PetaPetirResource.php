<?php

declare(strict_types=1);

namespace App\Filament\Resources\PetaPetirs;

use App\Filament\Resources\PetaPetirs\Pages\CreatePetaPetir;
use App\Filament\Resources\PetaPetirs\Pages\EditPetaPetir;
use App\Filament\Resources\PetaPetirs\Pages\ListPetaPetirs;
use App\Filament\Resources\PetaPetirs\Schemas\PetaPetirForm;
use App\Filament\Resources\PetaPetirs\Tables\PetaPetirsTable;
use App\Models\PetaPetir;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class PetaPetirResource extends Resource
{
    protected static ?string $model = PetaPetir::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-map';

    protected static \UnitEnum|string|null $navigationGroup = 'Geofisika';

    protected static ?string $modelLabel = 'Peta Petir';

    protected static ?string $pluralModelLabel = 'Peta Kejadian Petir';

    protected static ?string $navigationLabel = 'Peta Kejadian Petir';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return PetaPetirForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PetaPetirsTable::configure($table);
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
            'index' => ListPetaPetirs::route('/'),
            'create' => CreatePetaPetir::route('/create'),
            'edit' => EditPetaPetir::route('/{record}/edit'),
        ];
    }
}
