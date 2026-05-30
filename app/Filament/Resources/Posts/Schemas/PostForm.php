<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
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
                            ->afterStateUpdated(fn (string $operation, $state, \Filament\Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
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
                            ->required(fn (\Filament\Forms\Get $get) => in_array($get('status'), ['published', 'scheduled']))
                            ->nullable(),
                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Select::make('author_id')
                            ->relationship('author', 'name')
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
                ])
            ]);
    }
}
