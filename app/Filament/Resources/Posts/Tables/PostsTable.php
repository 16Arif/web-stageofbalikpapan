<?php

namespace App\Filament\Resources\Posts\Tables;

use App\Models\Post;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ReplicateAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->circular()
                    ->defaultImageUrl(url('/favicon.ico')),
                TextColumn::make('title')
                    ->searchable()
                    ->limit(50),
                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'danger' => 'draft',
                        'warning' => 'scheduled',
                        'success' => 'published',
                        'secondary' => 'archived',
                    ]),
                TextColumn::make('category.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('author.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'scheduled' => 'Scheduled',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ]),
                SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Category'),
                SelectFilter::make('author_id')
                    ->relationship('author', 'name')
                    ->label('Author'),
                Filter::make('published_at')
                    ->form([
                        DatePicker::make('published_from'),
                        DatePicker::make('published_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['published_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('published_at', '>=', $date),
                            )
                            ->when(
                                $data['published_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('published_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Action::make('preview')
                    ->url(fn (Post $record): string => route('activity.show', $record->slug))
                    ->icon('heroicon-o-eye')
                    ->openUrlInNewTab(),
                Action::make('publish')
                    ->action(fn (Post $record) => $record->update(['status' => 'published', 'published_at' => $record->published_at ?? now()]))
                    ->requiresConfirmation()
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Post $record): bool => $record->status !== 'published'),
                Action::make('unpublish')
                    ->action(fn (Post $record) => $record->update(['status' => 'draft']))
                    ->requiresConfirmation()
                    ->icon('heroicon-o-x-circle')
                    ->color('warning')
                    ->visible(fn (Post $record): bool => $record->status === 'published'),
                EditAction::make(),
                ReplicateAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
