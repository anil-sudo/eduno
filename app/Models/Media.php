<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Enums
use App\Enums\MediaType;
use App\Enums\MediaFormat;
use App\Enums\VisibilityType;

// Spatie Tags
use Spatie\Tags\HasTags;

class Media extends Model
{
    use HasTags;
    
    protected $fillable = [
        'caption', 

        'type', 
        'visibility',
        'format',

        'image',
        'video',

        'poster',
    ];

    protected $casts = [
        'type' => MediaType::class,
        'format' => MediaFormat::class,
        'visibility' => VisibilityType::class,
    ];
}
