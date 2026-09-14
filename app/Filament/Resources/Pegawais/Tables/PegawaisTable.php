<?php

declare(strict_types=1);

namespace App\Filament\Resources\Pegawais\Tables;

use App\Models\Pegawai;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class PegawaisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama Pegawai')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('nip')
                    ->label('NIP')
                    ->placeholder('-')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jabatan')
                    ->label('Jabatan')
                    ->placeholder('-')
                    ->searchable(),

                TextColumn::make('kategori')
                    ->label('Kategori')
                    ->formatStateUsing(fn (?string $state): string => Pegawai::getKategoriOptions()[$state] ?? (string) $state)
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        Pegawai::KATEGORI_KUPT => 'primary',
                        Pegawai::KATEGORI_TATA_USAHA => 'warning',
                        Pegawai::KATEGORI_FUNGSIONAL => 'info',
                        default => 'gray',
                    })
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Tampil')
                    ->boolean()
                    ->sortable()
                    ->alignCenter(),
            ])
            ->defaultSort('nip', 'asc')
            ->filters([
                SelectFilter::make('kategori')
                    ->label('Filter Kategori')
                    ->options(Pegawai::getKategoriOptions()),

                TernaryFilter::make('is_active')
                    ->label('Status Tampil')
                    ->placeholder('Semua')
                    ->trueLabel('Hanya yang Tampil')
                    ->falseLabel('Disembunyikan'),
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
