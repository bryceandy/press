<?php

namespace Bryceandy\Press\Console;

use Bryceandy\Press\Post;
use Bryceandy\Press\Press;
use Bryceandy\Press\PressFileParser;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProcessCommand extends Command
{
    protected $signature = 'press:process';

    protected $description = 'Updates blog posts';

    public function handle()
    {
        if (Press::configNotPublished()) {
            $this->warn('Please publish the config file by running'.
                ' \'php artisan vendor:publish --tag=press-config\'
            ');

            return;
        }
        $this->info('Processing posts...');

        try {
            $posts = Press::driver()->fetchPosts();

            collect($posts)->map( fn($post) => Post::create([
                'identifier' => $post['identifier'],
                'slug' => Str::slug($post['title']),
                'title' => $post['title'],
                'body' => $post['body'],
                'extra' => $post['extra'] ?? [],
            ]));
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }

        $this->info('Posts updated successfully!');
    }
}