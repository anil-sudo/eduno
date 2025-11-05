<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Spatie Tags
use Spatie\Tags\HasTags;

class Article extends Model
{
    use HasTags;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'cover',
        'content',
    ];

    public function authors()
    {
        return $this->belongsToMany(User::class, 'article_author');
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'article_topic');
    }
}
