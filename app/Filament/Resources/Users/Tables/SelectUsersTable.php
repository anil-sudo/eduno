<?php

namespace App\Filament\Resources\Users\Tables;

// Tables
use Filament\Tables\Table;

// Eloquent
use Illuminate\Database\Eloquent\Builder;

class SelectUsersTable extends UsersTable
{
    public static function configure(Table $table): Table
    {
        $table = parent::configure($table);

        return $table->modifyQueryUsing(fn (Builder $query) => 
            $query->whereNotNull('avatar')
        );
    }
}