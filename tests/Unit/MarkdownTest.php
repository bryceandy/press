<?php

namespace Bryceandy\Press\Tests;

use Bryceandy\Press\MarkdownParser;
use Orchestra\Testbench\TestCase;

class MarkdownTest extends TestCase
{
    /**
     * @test
     */
    public function a_level_one_header_can_be_parsed()
    {
        $heading = MarkdownParser::parse('# This is a heading');

        $this->assertEquals($heading, '<h1>This is a heading</h1>');
    }
}
