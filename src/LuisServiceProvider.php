<?php

namespace Poowf\LaravelLuis;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Merge configuration.
     */
    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/laravel-luis.php', 'laravel-luis'
        );
    }

        /**
     * Setup the resource publishing groups for Otter.
     *
     * @return void
     */
    protected function offerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/laravel-luis.php' => config_path('laravel-luis.php'),
            ], 'laravel-luis-config');
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('laravel-luis', function ($app) {
            return $app->make(LaravelLuis::class);
        });

        $this->mergeConfig();
        $this->offerPublishing();
    }
}