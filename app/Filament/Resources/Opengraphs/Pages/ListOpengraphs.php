<?php

namespace App\Filament\Resources\Opengraphs\Pages;

use App\Filament\Resources\Opengraphs\OpengraphResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOpengraphs extends ListRecords
{
    protected static string $resource = OpengraphResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
