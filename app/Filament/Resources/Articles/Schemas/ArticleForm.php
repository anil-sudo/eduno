<?php

namespace App\Filament\Resources\Articles\Schemas;

// Schemas
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;

// Icon
use Filament\Support\Icons\Heroicon;

// Actions
use Filament\Actions\Action;

// Forms
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\ModalTableSelect;

// Tables
use App\Filament\Resources\Users\Tables\SelectUsersTable;
use App\Filament\Resources\Categories\Tables\SelectCategoriesTable;

// Validation
use Illuminate\Support\Str;

// Model
use Spatie\Tags\Tag;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Article Info')
                    ->description('Set the name, slug and author for this article.')
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
                            ->directory('eduno/media/articles')
                            ->maxSize(128),                  
                    ])
                    ->columnSpanFull(),

                Section::make('Page Meta')
                    ->description('Add an author and tags for this article.')
                    ->schema([
                        ModalTableSelect::make('authors')
                            ->label('Authors')
                            ->relationship(
                                name: 'authors', 
                                titleAttribute: 'name',
                            )
                            ->tableConfiguration(SelectUsersTable::class)
                            ->selectAction(
                                fn (Action $action) => $action
                                ->label('Select an authors')
                                ->modalHeading('Search for an authors'),
                            )
                            ->multiple()
                            ->required(),  
                        
                        ModalTableSelect::make('category')
                            ->label('Category')
                            ->relationship(
                                name: 'topics', 
                                titleAttribute: 'name',
                            )
                            ->tableConfiguration(SelectCategoriesTable::class)
                            ->selectAction(
                                fn (Action $action) => $action
                                ->label('Select a category')
                                ->modalHeading('Search for a category'),
                            )
                            ->rules(['array', 'max:1'])
                            ->multiple(),   
                        
                        SpatieTagsInput::make('tags')
                            ->columnSpanFull()
                            ->prefixIcon(Heroicon::Tag)
                            ->reorderable()
                            ->color('gray')
                            ->rules(['array', 'max:5'])
                            ->splitKeys(['Tab', ' '])
                            ->nestedRecursiveRules([
                                'min:3',
                                'max:15',
                            ])
                            ->required(),                  
                    ])
                    ->columnSpanFull()
                    ->columns(2),

                Section::make('Article Content')
                    ->description('Write the main content of the article.')
                    ->schema([
                        RichEditor::make('content')
                            ->label('Article Content')
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