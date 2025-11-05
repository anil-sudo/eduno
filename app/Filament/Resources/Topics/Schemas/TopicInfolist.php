<?php

namespace App\Filament\Resources\Topics\Schemas;

// Schema
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Section;

// Entries
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\KeyValueEntry;

class TopicInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Flex::make([
                    Section::make('Topic Overview')
                        ->description('View key information about the topic, including its name, description, and cover.')
                        ->schema([
                            TextEntry::make('name')
                                ->copyable()                                
                                ->columnSpanFull(),
                            
                            TextEntry::make('slug')
                                ->badge()
                                ->copyable()                
                                ->color('gray'),

                            TextEntry::make('category.name')
                                ->label('Category')
                                ->badge()
                                ->copyable()                
                                ->color('gray'),

                            TextEntry::make('description')
                                ->columnSpanFull(),

                            ImageEntry::make('cover')
                                ->disk('r2')
                                ->extraImgAttributes([
                                    'class' => 'rounded-md',
                                    'loading' => 'lazy',
                                    'style' => 'border-radius: 0.25rem;'
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