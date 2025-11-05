<?php

namespace App\Filament\Resources\Articles\Tables;

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

class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),

                ImageColumn::make('authors.avatar')
                    ->label('Authors')
                    ->disk('r2')
                    ->circular()
                    ->stacked()                    
                    ->checkFileExistence(false)
                    ->limit(2)
                    ->limitedRemainingText(),
                
                SpatieTagsColumn::make('tags')                    
                    ->color('gray'),

                ImageColumn::make('cover')
                    ->disk('r2')
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
                //
            ])
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