<?php

namespace Bagoesz21\LaravelSitemap\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelSitemap extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-sitemap';
    }
}
