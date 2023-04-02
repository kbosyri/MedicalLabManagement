<?php

namespace App\Providers;

use App\GetPatientTestValues\GetPatientTestValues;
use Illuminate\Support\ServiceProvider;

class GetPatientTestValuesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('GetPatientTestValues',function()
        {
            return new GetPatientTestValues();
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
