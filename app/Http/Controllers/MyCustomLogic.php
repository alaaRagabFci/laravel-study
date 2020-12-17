<?php

namespace App\Http\Controllers;

class MyCustomLogic
{
    protected $baseNumber;

    public function __construct(int $baseNumber)
    {
        $this->baseNumber = $baseNumber;
    }

    public function add(int $sum)
    {
        return $this->baseNumber + $sum;
    }
}
