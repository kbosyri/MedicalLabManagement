<?php

namespace App\Providers;

use App\GetTestElements\GetTestElements;
use Illuminate\Support\ServiceProvider;

class GetTestElementsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('GetTestElements',function()
        {
            return new GetTestElements();
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
