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

    /**
     * @test
     */
    public function a_level_two_header_can_be_parsed()
    {
        $heading = MarkdownParser::parse('## This is another heading');

        $this->assertEquals($heading, '<h2>This is another heading</h2>');
    }
}
