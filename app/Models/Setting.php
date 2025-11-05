<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Observer
use App\Observers\SettingObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([SettingObserver::class])]
class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];
}