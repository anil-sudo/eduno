<?php

namespace App\Filament\Resources\Contacts\Schemas;

// Schemas
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

// Forms
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

// Support
use Filament\Support\Icons\Heroicon;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Contact Details')
                    ->description('Provide the essential information needed to create or edit a contact.')
                    ->schema([                        
                        TextInput::make('name')
                            ->prefixIcon(Heroicon::User)
                            ->required()
                            ->rules(['required', 'string', 'min:3', 'max:32'])
                            ->columnSpanFull(),

                        TextInput::make('email')
                            ->email()
                            ->rules(['required', 'email:rfc,dns'])
                            ->prefixIcon(Heroicon::Envelope)
                            ->required(),

                        TextInput::make('phone')
                            ->prefixIcon(Heroicon::Phone)
                            ->tel()
                            ->nullable()
                            ->rules(['nullable', 'regex:/^9[0-9]{9}$/']),

                        Textarea::make('message')
                            ->required()
                            ->rules(['required', 'string', 'min:32', 'max:500'])
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull()
                    ->columns(2),              
            ]);
    }
}