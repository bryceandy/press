<?php

namespace Bryceandy\Press;

use Illuminate\Support\Facades\File;
use Bryceandy\Press\Facades\Press;
use ReflectionClass;
use ReflectionException;

class PressFileParser
{
    protected $filename;

    protected $data;

    protected $rawData;

    public function __construct($filename)
    {
        $this->filename = $filename;

        $this->rawData = $this->splitFile();

        $this->explodeData();

        $this->processFields();
    }

    public function getRawData()
    {
        return $this->rawData;
    }

    public function getData()
    {
        return $this->data;
    }

    protected function splitFile()
    {
        preg_match(
            '/^-{3}(.*?)-{3}(.*)/s',
            File::exists($this->filename) ? File::get($this->filename) : $this->filename,
            $result
        );

        return $result;
    }

    protected function explodeData()
    {
        foreach (explode("\n", trim($this->rawData[1])) as $fieldString) {

            preg_match('/(.*):\s?(.*)/', $fieldString, $fieldArray);

            $this->data[$fieldArray[1]] = $fieldArray[2];
        }

        $this->data['body'] = trim($this->rawData[2]);
    }

    protected function processFields()
    {
        foreach ($this->data as $field => $value) {

            $class = $this->getFieldClass(ucfirst($field));

            if (! class_exists($class) && ! method_exists($class, 'process'))
                $class = 'Bryceandy\\Press\\Fields\\Extra';

            $this->data = array_merge(
                $this->data,
                $class::process($field, $value, $this->data)
            );
        }
    }

    /**
     * Checks if the appropriate class is available and returns it
     *
     * @param string $field
     * @return string
     * @throws ReflectionException
     */
    private function getFieldClass(string $field)
    {
        foreach (Press::getAvailableFields() as $availableField) {

            $class = new ReflectionClass($availableField);

            if ($class->getShortName() == $field) {
                return $class->getName();
            }
        };

        return null;
    }
}
