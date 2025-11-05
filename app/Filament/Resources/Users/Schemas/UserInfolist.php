<?php

namespace App\Filament\Resources\Users\Schemas;

// Entries
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;

// Schema   
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Section;

// Utilities
use Filament\Schemas\Components\Utilities\Get;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Flex::make([
                    Section::make('User Overview')
                        ->description('View key details about this user, including their name, email, and profile image.')
                        ->schema([
                            TextEntry::make('name')
                                ->label('Name')
                                ->columnSpanFull()
                                ->copyable(),

                            TextEntry::make('email')
                                ->copyable()
                                ->badge()
                                ->color('gray'),

                            TextEntry::make('position')
                                ->copyable()
                                ->badge()
                                ->color('gray'),

                            ImageEntry::make('avatar')
                                ->label('Avatar')
                                ->disk('r2')
                                ->circular()
                                ->imageSize(40)
                                ->checkFileExistence(false)
                                ->visible(fn (Get $get) => filled($get('avatar'))),
                        ])
                        ->columns(2),

                    Section::make('Timeline')
                        ->description('Account creation and last update timestamps.')
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