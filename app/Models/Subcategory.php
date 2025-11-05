<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'cover',
        'content',
    ];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
