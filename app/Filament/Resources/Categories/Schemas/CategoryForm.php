<?php

namespace App\Filament\Resources\Categories\Schemas;

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
use Filament\Forms\Components\ModalTableSelect;

// Actions
use Filament\Actions\Action;

// Tables
use App\Filament\Resources\Subcategories\Tables\SelectSubcategoriesTable;

// Validation
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Category Identity')
                    ->description('Set the name and slug for this category.')
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

                        ModalTableSelect::make('subcategory_id')
                            ->label('Subcategory')
                            ->relationship(
                                name: 'subcategory', 
                                titleAttribute: 'name',
                            )
                            ->tableConfiguration(SelectSubcategoriesTable::class)
                            ->selectAction(
                                fn (Action $action) => $action
                                ->label('Select a subcategory')
                                ->modalHeading('Search for a subcategory'),
                            )
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
                            ->directory('eduno/media/category')
                            ->maxSize(128),                  
                    ])
                    ->columnSpanFull(),

                Section::make('Category Content')
                    ->description('Write the main content of the category.')
                    ->schema([
                        RichEditor::make('content')
                            ->label('Category Content')
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