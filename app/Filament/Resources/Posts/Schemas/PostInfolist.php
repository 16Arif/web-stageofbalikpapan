<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PostInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title')
                    ->weight('bold')
                    ->size('lg'),
                TextEntry::make('slug'),
                \Filament\Infolists\Components\ImageEntry::make('featured_image')
                    ->columnSpanFull(),
                TextEntry::make('excerpt')
                    ->columnSpanFull(),
                TextEntry::make('content')
                    ->html()
                    ->columnSpanFull(),
                TextEntry::make('status')
                    ->badge()
                    ->colors([
                        'danger' => 'draft',
                        'warning' => 'scheduled',
                        'success' => 'published',
                        'secondary' => 'archived',
                    ]),
                TextEntry::make('published_at')
                    ->dateTime(),
                TextEntry::make('category.name')
                    ->label('Category')
                    ->placeholder('-'),
                TextEntry::make('author.name')
                    ->label('Author')
                    ->placeholder('-'),
                TextEntry::make('meta_title'),
                TextEntry::make('meta_description')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
