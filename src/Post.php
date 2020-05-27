<?php

namespace Bryceandy\Press;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    protected $casts = [
        'extra' => 'array',
    ];
}