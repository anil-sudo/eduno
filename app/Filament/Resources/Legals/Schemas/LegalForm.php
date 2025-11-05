<?php

namespace App\Filament\Resources\Legals\Schemas;

// Schemas
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;

// Icon
use Filament\Support\Icons\Heroicon;

// Enums
use App\Enums\LegalRoute;

// Actions
use Filament\Actions\Action;

// Forms
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\ModalTableSelect;

// Tables
use App\Filament\Resources\Media\Tables\SelectMediaTable;

class LegalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Page Identity')
                    ->description('Set the name and slug for this page.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Page Name')
                            ->prefixIcon('heroicon-m-signal')
                            ->required()
                            ->maxLength(60),

                        Select::make('slug')
                            ->label('Slug')
                            ->prefixIcon('heroicon-m-globe-alt')
                            ->options(LegalRoute::class)
                            ->searchable()
                            ->unique(ignoreRecord: true)
                            ->required(),
                    ])
                    ->columnSpanFull()
                    ->columns(2),

                Section::make('Page Meta')
                    ->description('Add a short description and an optional image for visual context.')
                    ->schema([
                        Textarea::make('description')
                            ->label('Meta Description')
                            ->maxLength(150),
                        
                        ModalTableSelect::make('media_id')
                            ->label('Media')
                            ->relationship(
                                name: 'media', 
                                titleAttribute: 'caption',
                            )
                            ->tableConfiguration(SelectMediaTable::class)
                            ->selectAction(
                                fn (Action $action) => $action
                                ->label('Select a media')
                                ->modalHeading('Search for a media'),
                            )
                            ->required(),                      
                    ])
                    ->columnSpanFull(),

                Section::make('Page Content')
                    ->description('Write the main content of the page.')
                    ->schema([
                        RichEditor::make('content')
                            ->label('Page Content')
                            ->mergeTags([
                                'name',
                                'email',
                                'location',
                                'company',                                
                                'domain',                                
                            ])
                            ->activePanel('mergeTags')
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}