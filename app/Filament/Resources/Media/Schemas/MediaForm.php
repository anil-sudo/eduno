<?php

namespace App\Filament\Resources\Media\Schemas;

// Schemas
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;

// Icon
use Filament\Support\Icons\Heroicon;

// Enums
use App\Enums\MediaType;
use App\Enums\MediaFormat;
use App\Enums\VisibilityType;

// Forms
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\SpatieTagsInput;

class MediaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('General Information')
                    ->description("Enter the media's caption and type.")
                    ->schema([
                        TextInput::make('caption')
                            ->columnSpanFull()
                            ->prefixIcon(Heroicon::ViewfinderCircle)
                            ->required(),
                        
                        Select::make('type')
                            ->options([
                                MediaType::Image->value => 'Image',
                                MediaType::Video->value => 'Video',
                            ])
                            ->searchable()
                            ->prefixIcon(Heroicon::Bolt)
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (Set $set, $state) {
                                $set('image', null);
                                $set('video', null);
                            }),

                        Select::make('visibility')
                            ->options(VisibilityType::class)
                            ->searchable()
                            ->prefixIcon(Heroicon::GlobeAlt)
                            ->required(),
                        
                        Select::make('format')
                            ->options(MediaFormat::class)
                            ->searchable()
                            ->prefixIcon(Heroicon::RectangleGroup)
                            ->required(),

                        SpatieTagsInput::make('tags')
                            ->columnSpanFull()
                            ->prefixIcon(Heroicon::Tag)
                            ->reorderable()
                            ->color('gray')
                            ->splitKeys(['Tab', ' '])
                            ->nestedRecursiveRules([
                                'min:3',
                                'max:15',
                            ])
                            ->required(),
                    ])
                    ->columnSpanFull()
                    ->columns(3),

                Section::make('Media File')
                    ->description("Upload a media file depending on the selected type.")
                    ->schema([
                        FileUpload::make('image')
                            ->label('Image')
                            ->image() 
                            ->acceptedFileTypes(['image/webp', 'image/jpeg', 'image/png'])
                            ->imageEditor()
                            ->openable()
                            ->downloadable()
                            ->previewable()
                            ->required(fn (Get $get): bool => $get('type') === MediaType::Image->value)
                            ->disk('r2') 
                            ->directory('eduno/media/all/images')
                            ->maxSize(128)
                            ->columnSpanFull()
                            ->visible(fn (Get $get): bool => $get('type') === MediaType::Image->value),

                        FileUpload::make('video')
                            ->label('Video')
                            ->acceptedFileTypes(['video/mp4'])
                            ->openable()
                            ->downloadable()
                            ->previewable()
                            ->required(fn (Get $get): bool => $get('type') === MediaType::Video->value) 
                            ->disk('r2') 
                            ->directory('eduno/media/all/videos')
                            ->maxSize(5120)
                            ->visible(fn (Get $get): bool => $get('type') === MediaType::Video->value),  

                        FileUpload::make('poster')
                            ->label('Poster')
                            ->image() 
                            ->acceptedFileTypes(['image/webp', 'image/jpeg', 'image/png'])
                            ->imageEditor()
                            ->openable()
                            ->downloadable()
                            ->previewable()
                            ->deletable()
                            ->required(fn (Get $get): bool => $get('type') === MediaType::Video->value) 
                            ->disk('r2') 
                            ->directory('eduno/media/all/posters')
                            ->maxSize(128)
                            ->visible(fn (Get $get): bool => $get('type') === MediaType::Video->value),  
                    ])
                    ->live()
                    ->columns(2)
                    ->columnSpanFull()
                    ->hidden(fn (Get $get): bool => !$get('type')),
            ]);
    }
}