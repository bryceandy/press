<?php

namespace Bryceandy\Press;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class PressFileParser
{
    protected String $filename;

    protected Array $data;

    public function __construct($filename)
    {
        $this->filename = $filename;

        $this->data = $this->splitFile();

        $this->explodeData();

        $this->processFields();
    }

    public function getData()
    {
        return $this->data;
    }

    protected function splitFile()
    {
        preg_match('/^-{3}(.*?)-{3}(.*)/s',
            File::exists($this->filename) ? File::get($this->filename) : $this->filename,
        $result
        );

        return $result;
    }

    protected function explodeData()
    {
        foreach (explode("\n", trim($this->data[1])) as $fieldString) {

            preg_match('/(.*):\s?(.*)/', $fieldString, $fieldArray);

            $this->data[$fieldArray[1]] = $fieldArray[2];
        }

        $this->data['body'] = preg_replace('/\R/','\n', trim($this->data[2]));
    }

    protected function processFields()
    {
        foreach ($this->data as $field => $value) {
            if ($field === 'date') {
                $this->data[$field] = Carbon::parse($value);
            }
        }
    }
}
