<?php

namespace Bryceandy\Press\Tests;

use Bryceandy\Press\PressFileParser;
use Carbon\Carbon;
use Orchestra\Testbench\TestCase;

class PressFileParserTest extends TestCase
{
    protected Array $data;

    private PressFileParser $pressFileParser;

    public function setUp(): void
    {
        parent::setUp();

        $contentToBeParsed = [
            __DIR__.'/../blogs/MarkFile1.md',
            "---\ntitle: My title\ndescription: Description here\n---\n\n# Heading\n\nBlog post body here",
        ];

        $randomIndex = array_rand($contentToBeParsed);

        $this->pressFileParser = (new PressFileParser($contentToBeParsed[$randomIndex]));

        /** @noinspection PhpFieldAssignmentTypeMismatchInspection */
        $this->data = $this->pressFileParser->getData();
    }

    /**
     * @test
     */
    public function the_head_and_body_gets_split()
    {
        $data = $this->pressFileParser->getRawData();

        $this->assertStringContainsString('title: My title', $data[1]);

        $this->assertStringContainsString('description: Description here', $data[1]);
        
        $this->assertStringContainsString('Blog post body here', $data[2]);
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
    public function the_body_gets_parsed_and_trimmed()
    {
        $this->assertEquals(
            '<h1>Heading</h1>\n<p>Blog post body here</p>',
            preg_replace('/\R/', '\n', $this->data['body']) //Temp fix
        );
    }

    /**
     * @test
     */
    public function a_date_field_gets_parsed()
    {
        $pressFileParser = (new PressFileParser("---\ndate: Nov 15, 1993\n---\n"));

        $data = $pressFileParser->getData();

        $this->assertInstanceOf(Carbon::class, $data['date']);
        $this->assertEquals('11/15/1993', $data['date']->format('m/d/Y'));
    }

    /**
     * @test
     */
    public function an_extra_field_gets_saved()
    {
        $pressFileParser = (new PressFileParser("---\nauthor: John Doe\n---\n"));

        $data = $pressFileParser->getData();

        $this->assertEquals(json_encode(['author' => 'John Doe']), $data['extra']);
    }

    /**
     * @test
     */
    public function additional_fields_are_saved_into_extra()
    {
        $pressFileParser = (new PressFileParser(
            "---\nauthor: Jane Doe\nbook: Marvelous Nakamba\n---\n"
        ));

        $data = $pressFileParser->getData();

        $this->assertEquals(json_encode([
            'author' => 'Jane Doe',
            'book' => 'Marvelous Nakamba'
            ]),
            $data['extra']
        );
    }
}
