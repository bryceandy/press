<?php

namespace Bryceandy\Press\Drivers;

use Bryceandy\Press\Contracts\DriverContract;
use Bryceandy\Press\PressFileParser;
use Illuminate\Support\Facades\File;

class FileDriver extends DriverContract
{
    /**
     * @return array
     */
    public function fetchPosts()
    {
        // Fetch all posts
        $files = File::files(config('press.path'));

        // Process each file
        foreach ($files as $file)
            $this->posts[] = (new PressFileParser($file->getPathName()))->getData();

        return $this->posts;
    }
}