<?php

namespace App\Filament\Resources\Authors\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AuthorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Infolists\Components\ImageEntry::make('photo')
                    ->circular(),
                TextEntry::make('name')
                    ->weight('bold'),
                TextEntry::make('slug'),
                TextEntry::make('bio')
                    ->columnSpanFull()
                    ->placeholder('Belum ada bio.'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
