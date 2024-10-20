<?php

namespace App\Entity\Traits;

trait DataProccessTrait
{
    public function prepareData(\stdClass $data, callable &$classObj)
    {
        $arrayData = json_decode(json_encode((object)$data), true);
        $classObj->data = $arrayData;
    }

    public function validateData(array $data, array $constrains)
    {
        //todo validate data and throw exception in case of bad data
    }
}