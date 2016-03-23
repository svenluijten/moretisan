<?php

namespace Sven\Moretisan;

use Illuminate\Support\ServiceProvider;

class MoretisanServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['make:view'] = $this->app->share(function () {
            return new Commands\MakeViewCommand();
        });

        $this->commands(
            'make:view'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
