<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Helpers\Helpers;

class HelpersServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('helpers', function(){
            return new Helpers();
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
