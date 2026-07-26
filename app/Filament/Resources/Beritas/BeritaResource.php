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
                \Filament\Forms\Components\TextInput::make('judul')
                    ->label('Judul Berita')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (\Filament\Schemas\Components\Utilities\Set $set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state))),

                \Filament\Forms\Components\Hidden::make('slug'),

                \Filament\Forms\Components\FileUpload::make('gambar_thumbnail')
                    ->label('Gambar Thumbnail')
                    ->image()
                    ->disk('public')
                    ->maxSize(5120) // Batas maksimal upload 5MB
                    ->directory('berita')
                    ->visibility('public')
                    ->saveUploadedFileUsing(function ($file) {
                        $randomName = \Illuminate\Support\Str::random(20) . '.webp';
                        $filename = 'berita/' . $randomName;

                        $realPath = $file->getRealPath();

                        try {
                            $fileContents = file_get_contents($realPath);
                            $sourceImage = imagecreatefromstring($fileContents);

                            if ($sourceImage !== false) {
                                // Konversi palet ke true color (wajib untuk beberapa format PNG/GIF)
                                imagepalettetotruecolor($sourceImage);

                                // Pastikan transparansi (alpha channel) dipertahankan
                                imagealphablending($sourceImage, true);
                                imagesavealpha($sourceImage, true);

                                // Tangkap output gambar ke dalam buffer (kualitas 80%)
                                ob_start();
                                imagewebp($sourceImage, null, 80);
                                $webpData = ob_get_clean();

                                // Bersihkan memori dari gambar sumber (hapus gambar 5MB dari RAM)
                                imagedestroy($sourceImage);

                                // Simpan file WebP ke disk 'public'
                                \Illuminate\Support\Facades\Storage::disk('public')->put($filename, $webpData);

                                return $filename;
                            }
                        } catch (\Throwable $e) {
                            // Jika terjadi error pada GD saat konversi (misal format tidak dikenali),
                            // tangani error secara diam-diam dan biarkan sistem turun ke fallback di bawah.
                            \Illuminate\Support\Facades\Log::warning('Gagal konversi gambar ke WebP: ' . $e->getMessage());
                        }

                        // Fallback: Jika gagal konversi, simpan gambar aslinya dengan ekstensi aslinya
                        $fallbackName = \Illuminate\Support\Str::random(20) . '.' . $file->getClientOriginalExtension();
                        return $file->storeAs('berita', $fallbackName, 'public');
                    }),

                \Filament\Forms\Components\RichEditor::make('konten')
                    ->label('Konten Berita')
                    ->required()
                    ->disableToolbarButtons([
                        'blockquote',
                        'codeBlock',
                        'attachFiles',
                        'table', // Secara bawaan tidak ada, tapi disertakan untuk berjaga-jaga jika ada plugin
                    ])
                    /*
                    |--------------------------------------------------------------------------
                    | CATATAN PENGEMBANG
                    |--------------------------------------------------------------------------
                    | Jika di masa depan Anda membutuhkan kembali fitur Blockquote, Code Block,
                    | Attach Files (Lampiran File), atau Table, Anda cukup menghapus atau
                    | me-remark (//) parameter di dalam array ->disableToolbarButtons() di atas.
                    */
                    ->columnSpanFull(),

                \Filament\Forms\Components\TextInput::make('penulis')
                    ->label('Penulis / Peran')
                    ->default(fn () => auth()->user()?->role ?? (method_exists(auth()->user(), 'getRoleNames') ? auth()->user()->getRoleNames()->first() : auth()->user()?->name))
                    ->readOnly()
                    ->required(),

                \Filament\Forms\Components\DateTimePicker::make('published_at')
                    ->label('Tanggal Publikasi'),

                \Filament\Forms\Components\Toggle::make('is_publish')
                    ->label('Publikasikan Berita')
                    ->default(false)
                    ->helperText('Aktifkan untuk menerbitkan berita ke publik. Biarkan mati untuk menyimpan sebagai Draf.'),
            ]);
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
