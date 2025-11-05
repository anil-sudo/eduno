<?php

namespace App\Filament\Resources\Opengraphs\Pages;

use App\Filament\Resources\Opengraphs\OpengraphResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditOpengraph extends EditRecord
{
    protected static string $resource = OpengraphResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
