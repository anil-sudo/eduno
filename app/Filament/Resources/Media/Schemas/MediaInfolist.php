<?php

namespace App\Filament\Resources\Media\Schemas;

// Utilities
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;

// Schema
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Section;

// Entries
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\SpatieTagsEntry;

// Enums
use App\Enums\MediaType;
use App\Enums\MediaFormat;
use App\Enums\VisibilityType;

class MediaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Flex::make([
                    Section::make('Media Overview')
                        ->description('View key information about the media item, including its caption, type, visibility, and poster.')
                        ->schema([
                            TextEntry::make('caption')
                                ->columnSpanFull(),

                            TextEntry::make('type')
                                ->badge()
                                ->color(fn (MediaType $state): string => match ($state) {
                                    MediaType::Image => 'info',
                                    MediaType::Video => 'danger',   
                                    default => 'gray',                     
                                }),

                            TextEntry::make('visibility')
                                ->badge()
                                ->color(fn (VisibilityType $state): string => match ($state) {
                                    VisibilityType::Private => 'gray',
                                    VisibilityType::Public => 'warning',   
                                    default => 'warning',                     
                                }),

                            TextEntry::make('format')
                                ->badge()
                                ->color(fn (MediaFormat $state): string => match ($state) {
                                    MediaFormat::Landscape => 'info',
                                    MediaFormat::Portrait => 'success',   
                                    default => 'gray',                     
                                }),

                            SpatieTagsEntry::make('tags')
                                ->label('Tags')
                                ->badge()
                                ->color('gray'),

                            ImageEntry::make('image')
                                ->visible(fn (Get $get): bool => $get('type') === MediaType::Image)
                                ->disk('r2')
                                ->extraImgAttributes([
                                    'class' => 'rounded-md',
                                    'loading' => 'lazy',
                                    'style' => 'border-radius: 0.25rem;',
                                ])
                                ->checkFileExistence(false)
                                ->columnSpanFull(),

                            ImageEntry::make('poster')
                                ->visible(fn (Get $get): bool => $get('type') === MediaType::Video)
                                ->disk('r2')
                                ->extraImgAttributes([
                                    'class' => 'rounded-md',
                                    'loading' => 'lazy',
                                    'style' => 'border-radius: 0.25rem;',
                                ])
                                ->checkFileExistence(false)
                                ->columnSpanFull(),
                        ])
                        ->columns(3),

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