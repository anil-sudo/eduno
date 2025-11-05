<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Enums
use App\Enums\LegalRoute;

class Legal extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'media_id',
        'content',
    ];

    protected $casts = [
        'slug' => LegalRoute::class,
    ];

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
}