<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class MyCustomFacade extends Facade
{
  protected static function getFacadeAccessor()
  {
    return 'myCustom-logic';
  }
}
