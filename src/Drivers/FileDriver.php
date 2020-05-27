<?php

namespace Bryceandy\Press\Drivers;

use Bryceandy\Press\Contracts\DriverContract;
use Bryceandy\Press\Exceptions\FileDriverDirectoryNotFoundException;
use Bryceandy\Press\PressFileParser;
use Illuminate\Support\Facades\File;

class FileDriver extends DriverContract
{
    /**
     * @return array
     */
    public function fetchPosts()
    {
        // Fetch all markdown files in the driver
        $files = File::files($this->config['path']);

        // Process each file
        foreach ($files as $file)
            $this->parse($file->getPathName(), $file->getFileName());

        return $this->posts;
    }

    /**
     * Checks whether the file source exists
     *
     * @throws FileDriverDirectoryNotFoundException
     * @return bool
     */
    protected function validateSource()
    {
        if (! File::exists($this->config['path'])) {

            throw new FileDriverDirectoryNotFoundException(
                'Directory at \'' . $this->config['path'] .
                '\' does not exist. Please check the directory path in the configuration file.'
            );
        }

        return true;
    }
}