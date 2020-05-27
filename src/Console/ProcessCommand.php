<?php

namespace Bryceandy\Press\Console;

use Bryceandy\Press\Post;
use Bryceandy\Press\PressFileParser;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProcessCommand extends Command
{
    protected $signature = 'press:process';

    protected $description = 'Updates blog posts';

    public function handle()
    {
        if (is_null(config('press'))) {
            $this->warn('Please publish the config file by running'.
                ' \'php artisan vendor:publish--tag=press-config\'
            ');

            return;
        }
        $this->info('Processing posts...');

        // Fetch all posts
        $files = File::files(config('press.path'));

        // Process each file
        foreach($files as $file) {

            $post = (new PressFileParser($file->getPathName()))->getData();

            Post::create([
                'identifier' => Str::random(),
                'slug' => Str::slug($post['title']),
                'title' => $post['title'],
                'body' => $post['body'],
                'extra' => $post['extra'] ?? [],
            ]);
        }

        $this->info('Posts updated successfully!');
    }
}