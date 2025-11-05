<?php

namespace App\Filament\Resources\Opengraphs\Pages;

use App\Filament\Resources\Opengraphs\OpengraphResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewOpengraph extends ViewRecord
{
    protected static string $resource = OpengraphResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
