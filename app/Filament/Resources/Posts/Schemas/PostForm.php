<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)->schema([
                    Section::make('Post Details')->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Textarea::make('excerpt')
                            ->required()
                            ->maxLength(500)
                            ->columnSpanFull(),
                        RichEditor::make('content')
                            ->required()
                            ->columnSpanFull(),
                    ])->columnSpan(2),

                    Section::make('Meta & Status')->schema([
                        Select::make('status')
                            ->required()
                            ->options([
                                'draft' => 'Draft',
                                'scheduled' => 'Scheduled',
                                'published' => 'Published',
                                'archived' => 'Archived',
                            ])
                            ->default('draft')
                            ->live(),
                        DateTimePicker::make('published_at')
                            ->required(fn (Get $get) => in_array($get('status'), ['published', 'scheduled']))
                            ->nullable(),
                        Select::make('category_id')
                            ->relationship('categoryRelation', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Select::make('author_id')
                            ->relationship('authorRelation', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        FileUpload::make('featured_image')
                            ->image()
                            ->imageEditor()
                            ->directory('posts'),
                    ])->columnSpan(1),

                    Section::make('SEO Settings')->schema([
                        TextInput::make('meta_title')
                            ->maxLength(60),
                        Textarea::make('meta_description')
                            ->maxLength(160)
                            ->columnSpanFull(),
                    ])->columnSpanFull(),
                ]),
            ]);
    }
}
