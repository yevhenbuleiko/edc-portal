<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Helpers\CommandHelpers;

class CommandsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('commandhelpers', function(){
            return new CommandHelpers();
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
