<?php

declare(strict_types=1);

namespace App\Filament\Resources\GempaKalimantans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GempaKalimantansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('peta_gempa')
                    ->label('Peta')
                    ->collection('peta_gempa')
                    ->disk('public'),

                TextColumn::make('waktu_gempa')
                    ->label('Waktu (WIB)')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                TextColumn::make('magnitudo')
                    ->label('Mag')
                    ->badge()
                    ->color(fn ($state): string => (float) $state >= 4.0 ? 'danger' : 'gray')
                    ->sortable(),

                TextColumn::make('kedalaman')
                    ->label('Kedalaman'),

                TextColumn::make('wilayah')
                    ->label('Wilayah')
                    ->searchable()
                    ->wrap(),

                TextColumn::make('koordinat')
                    ->label('Koordinat')
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean(),
            ])
            ->defaultSort('waktu_gempa', 'desc')
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
