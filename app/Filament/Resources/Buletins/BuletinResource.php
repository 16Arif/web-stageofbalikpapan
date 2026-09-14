<?php

namespace App\Filament\Resources\Buletins;

use App\Filament\Resources\Buletins\Pages\CreateBuletin;
use App\Filament\Resources\Buletins\Pages\EditBuletin;
use App\Filament\Resources\Buletins\Pages\ListBuletins;
use App\Models\Buletin;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class BuletinResource extends Resource
{
    protected static ?string $model = Buletin::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static \UnitEnum|string|null $navigationGroup = 'Publikasi';

    protected static ?string $navigationLabel = 'Buletin';

    protected static string|null $modelLabel = 'Buletin';

    protected static string|null $pluralModelLabel = 'Daftar Buletin';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\TextInput::make('title')
                    ->label('Judul Buletin')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (\Filament\Schemas\Components\Utilities\Set $set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state))),

                \Filament\Forms\Components\Hidden::make('slug'),

                \Filament\Forms\Components\Select::make('bulan')
                    ->label('Bulan')
                    ->options([
                        '1' => 'Januari',
                        '2' => 'Februari',
                        '3' => 'Maret',
                        '4' => 'April',
                        '5' => 'Mei',
                        '6' => 'Juni',
                        '7' => 'Juli',
                        '8' => 'Agustus',
                        '9' => 'September',
                        '10' => 'Oktober',
                        '11' => 'November',
                        '12' => 'Desember',
                    ])
                    ->required(),

                \Filament\Forms\Components\Select::make('tahun')
                    ->label('Tahun')
                    ->options(array_combine(range(2020, (int) date('Y') + 2), range(2020, (int) date('Y') + 2)))
                    ->required(),

                \Filament\Forms\Components\FileUpload::make('file_path')
                    ->label('File Buletin (PDF)')
                    ->required()
                    ->disk('public')
                    ->directory('buletin')
                    ->visibility('public')
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(10240),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('tahun', 'desc')
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),

                \Filament\Tables\Columns\TextColumn::make('bulan')
                    ->label('Bulan')
                    ->formatStateUsing(fn (mixed $state): string => match ((string) $state) {
                        '1' => 'Januari',
                        '2' => 'Februari',
                        '3' => 'Maret',
                        '4' => 'April',
                        '5' => 'Mei',
                        '6' => 'Juni',
                        '7' => 'Juli',
                        '8' => 'Agustus',
                        '9' => 'September',
                        '10' => 'Oktober',
                        '11' => 'November',
                        '12' => 'Desember',
                        default => (string) $state,
                    })
                    ->sortable(),

                \Filament\Tables\Columns\TextColumn::make('tahun')
                    ->label('Tahun')
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => ListBuletins::route('/'),
            'create' => CreateBuletin::route('/create'),
            'edit' => EditBuletin::route('/{record}/edit'),
        ];
    }
}
