<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsCollection;

class Feed extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'categories',
        'status',
        'published',
        'modified'
    ];

    protected $casts = [
        'content' => 'array',
        'categories' => AsCollection::class
    ];

    public function medias()
    {
        return $this->hasMany(Media::class);
    }
}
