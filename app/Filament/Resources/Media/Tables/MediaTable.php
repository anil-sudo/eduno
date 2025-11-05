<?php

namespace App\Filament\Resources\Media\Tables;

// Actions
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;

// Enums
use App\Enums\MediaType;
use App\Enums\MediaFormat;
use App\Enums\VisibilityType;

// Tables
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Enums\FiltersLayout;

class MediaTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('caption')
                    ->searchable(),
                
                TextColumn::make('type')
                    ->badge()
                    ->color(fn (MediaType $state): string => match ($state) {
                        MediaType::Image => 'info',
                        MediaType::Video => 'danger',   
                        default => 'gray',                     
                    })
                    ->searchable(),

                TextColumn::make('visibility')
                    ->badge()
                    ->color(fn (VisibilityType $state): string => match ($state) {
                        VisibilityType::Private => 'gray',
                        VisibilityType::Public => 'warning',   
                        default => 'warning',                     
                    })
                    ->searchable(),

                TextColumn::make('format')
                    ->badge()
                    ->color(fn (MediaFormat $state): string => match ($state) {
                        MediaFormat::Landscape => 'info',
                        MediaFormat::Portrait => 'success',   
                        default => 'gray',                     
                    })
                    ->searchable(),

                SpatieTagsColumn::make('tags')
                    ->color('gray'),

                ImageColumn::make('media')
                    ->disk('r2')
                    ->getStateUsing(function ($record) {
                        return $record->type === MediaType::Image
                            ? $record->image  
                            : $record->poster;
                    })
                    ->square()
                    ->checkFileExistence(false)
                    ->extraImgAttributes([
                        'class' => 'rounded-md w-full',
                        'loading' => 'lazy',
                        'style' => 'border-radius: 0.25rem;',
                    ]),

                TextColumn::make('created_at')
                    ->since()
                    ->dateTimeTooltip('M d, Y H:i A')
                    ->label('Created at')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->since()
                    ->dateTimeTooltip('M d, Y H:i A')
                    ->label('Last Update')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                    SelectFilter::make('type')
                        ->label('Type')
                        ->options(MediaType::class)
                        ->searchable(),
                        
                    SelectFilter::make('visibility')
                        ->label('Visibility')
                        ->options(VisibilityType::class)
                        ->searchable(),
                        
                    SelectFilter::make('format')
                        ->label('Format')
                        ->options(MediaFOrmat::class)
                        ->searchable(),
                ],
                layout: FiltersLayout::AboveContentCollapsible,
            )
            ->filtersFormColumns(3)
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}