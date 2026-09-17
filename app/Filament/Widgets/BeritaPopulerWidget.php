<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Berita;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class BeritaPopulerWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Berita::query()
                    ->orderByDesc('views_count')
                    ->take(5)
            )
            ->heading('5 Berita Terpopuler')
            ->paginated(false)
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('judul')
                    ->label('Judul Berita')
                    ->limit(45)
                    ->tooltip(function (\Filament\Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();

                        return is_string($state) && strlen($state) > 45 ? $state : null;
                    }),

                \Filament\Tables\Columns\TextColumn::make('views_count')
                    ->label('Total Views')
                    ->numeric()
                    ->badge()
                    ->color('success')
                    ->alignEnd(),
            ]);
    }
}
