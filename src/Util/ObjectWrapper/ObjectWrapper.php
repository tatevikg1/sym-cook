<?php

namespace App\Util\ObjectWrapper;

use stdClass;

class ObjectWrapper
{
    private stdClass $data;
    public function __construct(stdClass $data)
    {
        $this->data = $data;

        $this->processData();
    }

    private function processData()
    {
        foreach($this->data as $key => &$value){
            $this->processDatum($value, $key);
        }
    }

    private function processDatum($value, $key)
    {
    }


}