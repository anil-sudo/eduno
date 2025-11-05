<?php

namespace App\Filament\Resources\Contacts\Schemas;

// Entries
use Filament\Infolists\Components\TextEntry;

// Schema   
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Section;

// Utilities
use Filament\Schemas\Components\Utilities\Get;

class ContactInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Flex::make([
                    Section::make('Contact Overview')
                        ->description('View key details about this contact, including their name, email, and message.')
                        ->schema([
                            TextEntry::make('name')
                                ->copyable()                                
                                ->columnSpanFull(),

                            TextEntry::make('email')
                                ->copyable()
                                ->badge()
                                ->color('gray'),

                            TextEntry::make('phone')
                                ->copyable()
                                ->badge()
                                ->color('gray')
                                ->visible(fn (Get $get) => filled($get('phone'))),
                            
                            TextEntry::make('message')
                                ->copyable()
                                ->columnSpanFull(),
                        ])
                        ->columns(2),

                    Section::make('Timeline')
                        ->description('Contact creation and last update timestamps.')
                        ->schema([
                            TextEntry::make('created_at')
                                ->label('Created At')
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