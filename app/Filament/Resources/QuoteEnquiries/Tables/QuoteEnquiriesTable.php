<?php

namespace App\Filament\Resources\QuoteEnquiries\Tables;

use App\Models\QuoteEnquiry;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class QuoteEnquiriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('status')
                    ->badge()
                    ->sortable()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'warning',
                        'read' => 'info',
                        'quoted' => 'primary',
                        'won' => 'success',
                        'lost' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('project_name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('project_type')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('budget')
                    ->sortable(),
                TextColumn::make('timeframe')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'read' => 'Read',
                        'quoted' => 'Quoted',
                        'won' => 'Won',
                        'lost' => 'Lost',
                        'archived' => 'Archived',
                    ]),
                SelectFilter::make('project_type')
                    ->options([
                        'New website' => 'New website',
                        'Website redesign' => 'Website redesign',
                        'Landing page' => 'Landing page',
                        'Laravel / custom web app' => 'Laravel / custom web app',
                        'AI feature or automation' => 'AI feature or automation',
                        'Not sure yet' => 'Not sure yet',
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                Action::make('markRead')
                    ->label('Mark read')
                    ->visible(fn (QuoteEnquiry $record): bool => $record->status === 'new')
                    ->action(fn (QuoteEnquiry $record) => $record->update([
                        'status' => 'read',
                        'read_at' => now(),
                    ])),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
