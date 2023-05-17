<?php

namespace Mdhesari\Nasiba;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Mdhesari\Nasiba\Exceptions\NasibaInvalidConfigurationException;

class NasibaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'nasiba');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'nasiba');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ( $this->app->runningInConsole() ) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('nasiba.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/nasiba'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/nasiba'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/nasiba'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     * @throws NasibaInvalidConfigurationException
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'nasiba');

        if ( is_null(config('nasiba.merchant')) ) {
            throw new NasibaInvalidConfigurationException;
        }

        // Register the main class to use with the facade
        $this->app->singleton('nasiba', function () {
            return new Nasiba(
                config('nasiba.base_url'),
                $this->getNasibaConfig(),
                new Client([
                    'base_url'    => config('nasiba.base_url'),
                    'http_errors' => false,
                ])
            );
        });
    }

    private function getNasibaConfig()
    {
        return [
            'terminalCode' => config('nasiba.terminal'),
            'merchantCode' => config('nasiba.merchant'),
            'callbackUrl'  => config('nasiba.callback'),
            'signature'    => config('nasiba.signature'),
            'productId'    => config('nasiba.product_id'),
        ];
    }
}
