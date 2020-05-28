<?php

namespace Bryceandy\Press\Repositories;

use Bryceandy\Press\Post;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class PostRepository
{
    /**
     * Save or update a post
     *
     * @param $post
     */
    public function save($post)
    {
        Post::updateOrCreate([
            'identifier' => $post['identifier'],
        ],
            [
            'slug' => Str::slug($post['title']),
            'title' => $post['title'],
            'body' => $post['body'],
            'extra' => $this->extra($post),
        ]);
    }

    /**
     * Adds the extra properties that were defined by the user
     * 
     * @param $post
     * @return false|string
     */
    private function extra($post)
    {
        $extra = (array) json_decode($post['extra'] ?? '[]');

        $attributes = Arr::except($post, ['title', 'body', 'identifier']);

        return json_encode(array_merge($extra, $attributes));
    }
}
