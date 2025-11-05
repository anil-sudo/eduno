<?php

namespace App\Filament\Resources\Opengraphs;

use App\Filament\Resources\Opengraphs\Pages\CreateOpengraph;
use App\Filament\Resources\Opengraphs\Pages\EditOpengraph;
use App\Filament\Resources\Opengraphs\Pages\ListOpengraphs;
use App\Filament\Resources\Opengraphs\Pages\ViewOpengraph;
use App\Filament\Resources\Opengraphs\Schemas\OpengraphForm;
use App\Filament\Resources\Opengraphs\Schemas\OpengraphInfolist;
use App\Filament\Resources\Opengraphs\Tables\OpengraphsTable;
use App\Models\Opengraph;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OpengraphResource extends Resource
{
    protected static ?string $model = Opengraph::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPresentationChartLine;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 3;

    protected static string | \UnitEnum | null $navigationGroup = 'System';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return "Eduno's opengraphs";
    }

    public static function form(Schema $schema): Schema
    {
        return OpengraphForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return OpengraphInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OpengraphsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOpengraphs::route('/'),
            'create' => CreateOpengraph::route('/create'),
            'view' => ViewOpengraph::route('/{record}'),
            'edit' => EditOpengraph::route('/{record}/edit'),
        ];
    }
}
