<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'subcategory_id',
        'name',
        'slug',
        'description',
        'cover',
        'content',
    ];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}
