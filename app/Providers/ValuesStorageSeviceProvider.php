<?php

namespace App\Providers;

use App\ElementsValuesStorage\ValueStorage;
use Illuminate\Support\ServiceProvider;

class ValuesStorageSeviceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('valuestorage',function()
        {
            return new ValueStorage();
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
