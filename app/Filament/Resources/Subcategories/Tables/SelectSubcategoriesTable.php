<?php

namespace App\Filament\Resources\Subcategories\Tables;

// Tables
use Filament\Tables\Table;

// Eloquent
use Illuminate\Database\Eloquent\Builder;

class SelectSubcategoriesTable extends SubcategoriesTable
{
    public static function configure(Table $table): Table
    {
        $table = parent::configure($table);

        return $table->modifyQueryUsing(fn (Builder $query) => 
            $query->whereNotNull('slug')
        );
    }
}