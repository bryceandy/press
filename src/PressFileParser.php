<?php

namespace Bryceandy\Press;

use Illuminate\Support\Facades\File;

class PressFileParser
{

    protected String $filename;

    protected Array $data;

    public function __construct($filename)
    {
        $this->filename = $filename;

        $this->data = $this->splitFile();
    }

    public function getData()
    {
        return $this->data;
    }

    protected function splitFile()
    {
        preg_match('/^-{3}(.*?)-{3}(.*)/s',
            File::get($this->filename),
        $result
        );

        return $result;
    }
}
