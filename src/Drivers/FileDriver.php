<?php

namespace Bryceandy\Press\Drivers;

use Bryceandy\Press\PressFileParser;
use Illuminate\Support\Facades\File;

class FileDriver
{
    /**
     * @return array
     */
    public function fetchPosts()
    {
        // Fetch all posts
        $files = File::files(config('press.path'));

        $posts = [];
        // Process each file
        foreach ($files as $file)
            $posts[] = (new PressFileParser($file->getPathName()))->getData();

        return $posts ?? [];
    }
}