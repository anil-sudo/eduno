<?php

namespace App\Filament\Resources\Media\Tables;

// Tables
use Filament\Tables\Table;

// Eloquent
use Illuminate\Database\Eloquent\Builder;

// Enums
use App\Enums\VisibilityType;

class SelectMediaTable extends MediaTable
{
    public static function configure(Table $table): Table
    {
        $table = parent::configure($table);

        return $table->modifyQueryUsing(fn (Builder $query) => 
            $query->where('visibility', VisibilityType::Opengraph)
        );
    }
}