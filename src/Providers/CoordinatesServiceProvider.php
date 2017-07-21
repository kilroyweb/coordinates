<?php

namespace KilroyWeb\Coordinates\Providers;

use Illuminate\Support\ServiceProvider;

class CoordinatesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrations();
        $this->loadFactories();
        /*if ($this->app->runningInConsole()) {
            $this->commands([
                \KilroyWeb\Options\Commands\MakeOption::class,
            ]);
        }
        //
        $this->publishes([
            __DIR__.'/../Configuration/Templates/options.php' => config_path('options.php')
        ], 'config');*/
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

    private function loadMigrations(){
        $this->loadMigrationsFrom(__DIR__.'/../Migrations');
    }

    private function loadFactories(){
        $this->app->make('Illuminate\Database\Eloquent\Factory')->load(__DIR__.'/../Factories');
    }
}
