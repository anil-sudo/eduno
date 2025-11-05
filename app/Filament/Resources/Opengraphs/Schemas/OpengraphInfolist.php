<?php

namespace App\Filament\Resources\Opengraphs\Schemas;

// Schemas
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Section;

// Infolist
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\KeyValueEntry;

class OpengraphInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Flex::make([
                    Section::make('Legal Details')
                        ->description('Compressive information about the legal.')
                        ->schema([
                            TextEntry::make('name'),
                            
                            TextEntry::make('slug')
                                ->badge()
                                ->color('gray'),

                            TextEntry::make('description')
                                ->columnSpanFull(),
                        ])
                        ->columns(2),
                    
                    Section::make('Legal Metadata')
                        ->description('Includes image and timestamps.')
                        ->schema([
                            ImageEntry::make('media.image')
                                ->disk('r2')
                                ->extraImgAttributes([
                                    'class' => 'rounded-md w-full',
                                    'loading' => 'lazy',
                                    'style' => 'border-radius: 0.25rem;',
                                ])
                                ->checkFileExistence(false)
                                ->columnSpanFull(),

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
