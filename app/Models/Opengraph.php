<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Enums
use App\Enums\RouteType;

class Opengraph extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'media_id',
        'content',
    ];

    protected $casts = [
        'slug' => RouteType::class,
    ];

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
}
