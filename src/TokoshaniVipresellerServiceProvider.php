<?php

namespace Jstalinko\TokoshaniVipreseller;

use Illuminate\Support\ServiceProvider;

class TokoshaniVipresellerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'tokoshani-vipreseller');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'tokoshani-vipreseller');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('tokoshani-vipreseller.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/tokoshani-vipreseller'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/tokoshani-vipreseller'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/tokoshani-vipreseller'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'tokoshani-vipreseller');

        // Register the main class to use with the facade
        $this->app->singleton('tokoshani-vipreseller', function () {
            return new TokoshaniVipreseller;
        });
    }
}
