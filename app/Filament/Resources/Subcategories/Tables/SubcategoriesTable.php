<?php

namespace App\Filament\Resources\Subcategories\Tables;

// Actions
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;

// Tables
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class SubcategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('slug')
                    ->searchable()
                    ->badge()
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: false),

                ImageColumn::make('cover')
                    ->label('Feature Image')
                    ->disk('r2')
                    ->square()
                    ->checkFileExistence(false)
                    ->extraImgAttributes([
                        'class' => 'rounded-md w-full',
                        'loading' => 'lazy',
                        'style' => 'border-radius: 0.25rem;'
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