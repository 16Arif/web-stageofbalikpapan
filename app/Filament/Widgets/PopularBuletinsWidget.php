<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Buletin;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PopularBuletinsWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Buletin::query()
                    ->orderBy('views', 'desc')
                    ->limit(5)
            )
            ->heading('5 Buletin Terpopuler')
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('title')
                    ->label('Judul Buletin')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('bulan')
                    ->label('Bulan')
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('tahun')
                    ->label('Tahun')
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('views')
                    ->label('Total Views')
                    ->badge()
                    ->color('success')
                    ->icon('heroicon-o-eye')
                    ->sortable(),
            ])
            ->paginated(false);
    }
}
