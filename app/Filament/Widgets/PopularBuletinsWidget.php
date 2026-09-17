<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Buletin;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PopularBuletinsWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Buletin::query()
                    ->orderByDesc('views')
                    ->limit(5)
            )
            ->heading('5 Buletin Terpopuler')
            ->paginated(false)
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('title')
                    ->label('Judul Buletin')
                    ->limit(45)
                    ->tooltip(function (\Filament\Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();

                        return is_string($state) && strlen($state) > 45 ? $state : null;
                    }),

                \Filament\Tables\Columns\TextColumn::make('views')
                    ->label('Total Views')
                    ->numeric()
                    ->badge()
                    ->color('success')
                    ->alignEnd(),
            ]);
    }
}
