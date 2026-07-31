<?php

declare(strict_types=1);

namespace App\Filament\Resources\Beritas;

use App\Filament\Resources\Beritas\Pages\CreateBerita;
use App\Filament\Resources\Beritas\Pages\EditBerita;
use App\Filament\Resources\Beritas\Pages\ListBeritas;
use App\Models\Berita;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class BeritaResource extends Resource
{
    protected static ?string $model = Berita::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-newspaper';

    protected static \UnitEnum|string|null $navigationGroup = 'Publikasi';

    protected static ?string $modelLabel = 'Berita';

    protected static ?string $pluralModelLabel = 'Daftar Berita';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Kolom Kiri / Utama
                \Filament\Schemas\Components\Group::make([
                    \Filament\Schemas\Components\Section::make('Informasi Utama')
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('judul')
                                ->label('Judul Berita')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (\Filament\Schemas\Components\Utilities\Set $set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state))),

                            \Filament\Forms\Components\Hidden::make('slug'),

                            \Filament\Forms\Components\RichEditor::make('konten')
                                ->label('Konten Berita')
                                ->required()
                                ->disableToolbarButtons([
                                    'blockquote',
                                    'codeBlock',
                                    'attachFiles',
                                    'table',
                                ]),
                        ]),
                ])->columnSpan(2),

                // Kolom Kanan / Sidebar
                \Filament\Schemas\Components\Group::make([
                    \Filament\Schemas\Components\Section::make('Pengaturan Publikasi')
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('penulis')
                                ->label('Penulis')
                                ->default(fn () => auth()->user()?->role ?? (method_exists(auth()->user(), 'getRoleNames') ? auth()->user()->getRoleNames()->first() : auth()->user()?->name))
                                ->readOnly()
                                ->required(),

                            \Filament\Forms\Components\DateTimePicker::make('published_at')
                                ->label('Tanggal Publikasi')
                                ->default(fn () => now())
                                ->required(),

                            \Filament\Forms\Components\Toggle::make('is_publish')
                                ->label('Publikasikan Berita')
                                ->default(false)
                                ->helperText('Aktifkan untuk menerbitkan berita ke publik. Biarkan mati untuk menyimpan sebagai Draf.'),
                        ]),

                    \Filament\Schemas\Components\Section::make('Media')
                        ->schema([
                            \Filament\Forms\Components\SpatieMediaLibraryFileUpload::make('thumbnail')
                                ->label('Gambar Thumbnail')
                                ->collection('thumbnail')
                                ->disk('public')
                                ->image()
                                ->maxSize(5120) // Batas maksimal upload 5MB
                                ->required(),
                        ]),
                ])->columnSpan(1),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('judul')
                    ->label('Judul Berita')
                    ->searchable()
                    ->sortable(),

                \Filament\Tables\Columns\TextColumn::make('penulis')
                    ->label('Penulis')
                    ->searchable(),

                \Filament\Tables\Columns\TextColumn::make('published_at')
                    ->label('Tanggal Publikasi')
                    ->date('d F Y')
                    ->sortable(),

                \Filament\Tables\Columns\ToggleColumn::make('is_publish')
                    ->label('Status Publish'),
                    

                \Filament\Tables\Columns\TextColumn::make('views_count')
                    ->label('Jumlah Dilihat')
                    ->numeric()
                    ->sortable()
                    ->badge(),
            ])
            ->filters([])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBeritas::route('/'),
            'create' => CreateBerita::route('/create'),
            'edit' => EditBerita::route('/{record}/edit'),
        ];
    }
}
