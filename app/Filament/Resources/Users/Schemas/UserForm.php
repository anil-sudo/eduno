<?php

namespace App\Filament\Resources\Users\Schemas;

// Schemas
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

// Forms
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

// Support
use Filament\Support\Icons\Heroicon;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Account Details')
                    ->description('Provide the essential information needed to create or edit a user.')
                    ->schema([                        
                        TextInput::make('name')
                            ->prefixIcon(Heroicon::User)
                            ->columnSpanFull()
                            ->required(),

                        TextInput::make('email')
                            ->email()
                            ->prefixIcon(Heroicon::Envelope)
                            ->required(),

                        TextInput::make('position')
                            ->prefixIcon(Heroicon::Briefcase)
                            ->required(),
                    ])
                    ->columnSpanFull()
                    ->columns(2),

                Section::make('Profile Picture')
                    ->description('Add or change the user’s avatar image.')
                    ->schema([
                        FileUpload::make('avatar')
                            ->label('Avatar')
                            ->image() 
                            ->acceptedFileTypes(['image/webp'])
                            ->imageEditor()
                            ->openable()
                            ->downloadable()
                            ->previewable()
                            ->deletable()
                            ->disk('r2') 
                            ->directory('dhaugoda/media/avatar')
                            ->maxSize(128),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}