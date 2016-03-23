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
        $this->app['view:make'] = $this->app->share(function () {
            return new Commands\MakeViewCommand();
        });

        $this->commands(
            'view:make'
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
