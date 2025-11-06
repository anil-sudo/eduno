<?php

namespace App\Filament\Resources\Settings\Schemas;

// Schemas
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Section;

// Infolists
use Filament\Infolists\Components\TextEntry;

class SettingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Flex::make([
                    Section::make('Basic Information')
                        ->description('Configure basic settings for the application.')
                        ->schema([
                            TextEntry::make('key'),     
                            TextEntry::make('value')
                                ->badge()
                                ->color('gray'),     
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