<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsCollection;

class Media extends Model
{
    public $timestamps = false;
    public $table = "medias";
    protected $fillable = [
        'type',
        'media',
    ];

    protected $casts = [
        'media' => AsCollection::class
    ];

    public function feed()
    {
        return $this->belongsTo(Feed::class);
    }
}
