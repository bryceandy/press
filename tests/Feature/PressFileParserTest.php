<?php

namespace Bryceandy\Press\Tests;

use Bryceandy\Press\PressFileParser;
use Orchestra\Testbench\TestCase;

class PressFileParserTest extends TestCase
{
    protected Array $data;

    public function setUp(): void
    {
        parent::setUp();

        $pressFileParser = (new PressFileParser(__DIR__.'/../blogs/MarkFile1.md'));

        $this->data = $pressFileParser->getData();
    }

    /**
     * @test
     */
    public function the_head_and_body_gets_split()
    {
        $this->assertStringContainsString('title: My title', $this->data[1]);

        $this->assertStringContainsString('description: Description here', $this->data[1]);
        
        $this->assertStringContainsString('Blog post body here', $this->data[2]);
    }

    /**
     * @test
     */
    public function each_head_field_gets_separated()
    {
        $this->assertEquals('My title', $this->data['title']);

        $this->assertEquals('Description here', $this->data['description']);
    }

    /**
     * @test
     */
    public function the_body_gets_saved_and_trimmed()
    {
        $this->assertEquals('# Heading\n\nBlog post body here', $this->data['body']);
    }
}
