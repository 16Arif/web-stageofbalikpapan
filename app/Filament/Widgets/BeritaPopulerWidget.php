<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Berita;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class BeritaPopulerWidget extends BaseWidget
{
    protected static ?string $heading = '5 Berita Terpopuler';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Berita::query()
                    ->orderByDesc('views_count')
                    ->take(5)
            )
            ->paginated(false)
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('judul')
                    ->label('Judul Berita')
                    ->limit(60),

                \Filament\Tables\Columns\TextColumn::make('views_count')
                    ->label('Total Dilihat')
                    ->numeric()
                    ->badge()
                    ->color('success'),
            ]);
    }
}
