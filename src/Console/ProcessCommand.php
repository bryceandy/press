<?php

namespace Bryceandy\Press\Console;

use Bryceandy\Press\Facades\Press;
use Bryceandy\Press\Repositories\PostRepository;
use Exception;
use Illuminate\Console\Command;

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

            collect($posts)->map( fn($post) => (new PostRepository())->save($post));

            $this->info('Posts updated successfully!');

        } catch (Exception $exception) {

            $this->error($exception->getMessage());
        }
    }
}
