<?php

namespace App\Providers;

use App\Http\Controllers\MyCustomLogic;
use Illuminate\Support\ServiceProvider;

class MycustomLogicProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('myCustom-logic', function(){
            $baseNumber = 123;
            return new MyCustomLogic($baseNumber);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
