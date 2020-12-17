<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function createOrder(TestRequest $testRequest)
    {
        var_dump($testRequest->all());
    }
}
