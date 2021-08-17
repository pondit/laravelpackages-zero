<?php

namespace Mzr\Zero\Providers;

use Mzr\Zero\Zero;
use Illuminate\Support\ServiceProvider;

class ZeroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Register a class in the service container
        $this->app->bind('zero', function ($app) {
            return new Zero();
        });

        // register config
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'zero');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Mzr\Zero\Console\Commands\InstallZeroCommand::class,
            ]);

            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('zero.php'),
              ], 'config');
          
        }
    }
}
