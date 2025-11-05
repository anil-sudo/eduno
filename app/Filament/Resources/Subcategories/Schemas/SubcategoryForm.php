<?php

namespace App\Filament\Resources\Subcategories\Schemas;

// Schemas
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;

// Icon
use Filament\Support\Icons\Heroicon;

// Forms
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;

// Validation
use Illuminate\Support\Str;

class SubcategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Subcategory Identity')
                    ->description('Set the name and slug for this subcategory.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->prefixIcon(Heroicon::Signal)
                            ->required() 
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                $cleanedState = preg_replace('/\s+/', ' ', trim($state ?? ''));

                                $slug = Str::slug(str_replace('&', 'and', $cleanedState));

                                $set('slug', $slug);
                                $set('name', $cleanedState); 
                            })
                            ->maxLength(60),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->prefixIcon(Heroicon::GlobeAlt)
                            ->unique(ignoreRecord: true)
                            ->readonly()
                            ->required(),
                    ])
                    ->columnSpanFull()
                    ->columns(2),

                Section::make('Page Visual')
                    ->description('Add a short description and image for visual context.')
                    ->schema([
                        Textarea::make('description')
                            ->label('Description')
                            ->required()
                            ->maxLength(150)
                            ->autosize(),
                        
                        FileUpload::make('cover')
                            ->label('Cover')
                            ->image() 
                            ->acceptedFileTypes(['image/webp'])
                            ->imageEditor()
                            ->openable()
                            ->downloadable()
                            ->previewable()
                            ->deletable()
                            ->disk('r2') 
                            ->required()
                            ->directory('eduno/media/subcategory')
                            ->maxSize(128),                  
                    ])
                    ->columnSpanFull(),

                Section::make('Subcategory Content')
                    ->description('Write the main content of the subcategory.')
                    ->schema([
                        RichEditor::make('content')
                            ->label('Subcategory Content')
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