<?php

namespace Bryceandy\Press\Tests\Feature;

use Bryceandy\Press\Post;
use Bryceandy\Press\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SavePostsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_post_can_be_created_with_the_factory()
    {
        factory(Post::class)->create();

        $this->assertCount(1, Post::all());
    }
}
