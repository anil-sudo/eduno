<?php

namespace App\Filament\Resources\Settings\Schemas;

// Schemas
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

// Forms
use Filament\Forms\Components\TextInput;

// Support
use Filament\Support\Icons\Heroicon;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('General Settings')
                    ->description('View key information about the setting item, including its key and value.')
                    ->schema([
                        TextInput::make('key')
                            ->label('Key')
                            ->prefixIcon(Heroicon::Signal)
                            ->unique(ignoreRecord: true)
                            ->required(),

                        TextInput::make('value')
                            ->prefixIcon(Heroicon::Key)
                            ->label('Value')
                            ->required(),
                    ])
                    ->columnSpanFull()
                    ->columns(2),
            ]);
    }
}