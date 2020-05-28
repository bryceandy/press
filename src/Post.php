<?php

namespace Bryceandy\Press;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    /**
     * Attributes that should be casted to a datatype
     * @return array
     */
    protected $casts = [
        'extra' => 'array',
    ];

    /**
     * Enable a user to select an extra field without decoding
     * 
     * @return string|null
     */
    public function extra($field)
    {
        return optional(json_decode($this->extra))->$field;
    }
}
