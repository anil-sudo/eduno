<?php

namespace App\Filament\Resources\Articles\Schemas;

// Utilities
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;

// Schema
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Section;

// Entries
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\SpatieTagsEntry;

class ArticleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Flex::make([
                    Section::make('Article Overview')
                        ->description('View key information about the article, including its name, authors, tags, and cover.')
                        ->schema([
                            TextEntry::make('name')
                                ->columnSpanFull(),

                            TextEntry::make('slug')
                                ->badge()
                                ->color('gray'),

                            SpatieTagsEntry::make('tags')
                                ->label('Tags')
                                ->badge()
                                ->color('gray'),

                            TextEntry::make('topics.category.subcategory.name')
                                ->label('Subcategory')
                                ->badge()
                                ->color('gray'),

                            TextEntry::make('topics.category.name')
                                ->label('Category')
                                ->badge()
                                ->color('gray'),

                            TextEntry::make('topics.name')
                                ->label('Topics')
                                ->badge()
                                ->color('gray'),

                            ImageEntry::make('authors.avatar')
                                ->label('Authors')
                                ->disk('r2')
                                ->circular()
                                ->stacked()                    
                                ->checkFileExistence(false)
                                ->limit(2)
                                ->limitedRemainingText(),

                                
                            TextEntry::make('description')
                                ->columnSpanFull(),

                            ImageEntry::make('cover')
                                ->disk('r2')
                                ->extraImgAttributes([
                                    'class' => 'rounded-md',
                                    'loading' => 'lazy',
                                    'style' => 'border-radius: 0.25rem;',
                                ])
                                ->checkFileExistence(false)
                                ->columnSpanFull(),
                        ])
                        ->columns(2),

                    Section::make('Timeline')
                        ->description('Published and last updated times')
                        ->schema([
                            TextEntry::make('created_at')
                                ->label('Published')
                                ->since()
                                ->dateTimeTooltip('M d, Y H:i A'),
                            
                            TextEntry::make('updated_at')
                                ->label('Last Updated')
                                ->since()
                                ->dateTimeTooltip('M d, Y H:i A'),
                        ])
                        ->grow(false)
                        ->columns(2),
                ])
                ->columnSpanFull()
                ->from('md'),
            ]);
    }
}