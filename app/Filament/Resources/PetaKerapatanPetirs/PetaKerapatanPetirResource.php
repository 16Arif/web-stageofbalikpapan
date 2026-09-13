<?php

declare(strict_types=1);

namespace App\Filament\Resources\PetaKerapatanPetirs;

use App\Filament\Resources\PetaKerapatanPetirs\Pages\CreatePetaKerapatanPetir;
use App\Filament\Resources\PetaKerapatanPetirs\Pages\EditPetaKerapatanPetir;
use App\Filament\Resources\PetaKerapatanPetirs\Pages\ListPetaKerapatanPetirs;
use App\Filament\Resources\PetaKerapatanPetirs\Schemas\PetaKerapatanPetirForm;
use App\Filament\Resources\PetaKerapatanPetirs\Tables\PetaKerapatanPetirsTable;
use App\Models\PetaKerapatanPetir;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class PetaKerapatanPetirResource extends Resource
{
    protected static ?string $model = PetaKerapatanPetir::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-map';

    protected static \UnitEnum|string|null $navigationGroup = 'Geofisika';

    protected static ?string $modelLabel = 'Peta Kerapatan Petir';

    protected static ?string $pluralModelLabel = 'Peta Kerapatan Petir';

    protected static ?string $navigationLabel = 'Peta Kerapatan Petir';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return PetaKerapatanPetirForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PetaKerapatanPetirsTable::configure($table);
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
            'index' => ListPetaKerapatanPetirs::route('/'),
            'create' => CreatePetaKerapatanPetir::route('/create'),
            'edit' => EditPetaKerapatanPetir::route('/{record}/edit'),
        ];
    }
}
