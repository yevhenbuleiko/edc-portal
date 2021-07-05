<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Helpers\DataConvertors;

class DataConvertorsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('dataconvertors', function ($app) {
            return new DataConvertors();
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
