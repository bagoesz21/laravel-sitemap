<?php

namespace Bagoesz21\LaravelSitemap;

use Illuminate\Support\ServiceProvider;

class LaravelSitemapServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'bagoesz21');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'bagoesz21');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/sitemap.php', 'sitemap');

        // Register the service the package provides.
        $this->app->singleton('laravel-sitemap', function ($app) {
            return new LaravelSitemap;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravel-sitemap'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/sitemap.php' => config_path('sitemap.php'),
        ], 'laravel-sitemap.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/bagoesz21'),
        ], 'laravel-sitemap.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/bagoesz21'),
        ], 'laravel-sitemap.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/bagoesz21'),
        ], 'laravel-sitemap.views');*/

        // Registering package commands.
        $this->commands([
            Console\Commands\ClearSitemapCommand::class,
            Console\Commands\GenerateSitemapCommand::class,
        ]);
    }
}
