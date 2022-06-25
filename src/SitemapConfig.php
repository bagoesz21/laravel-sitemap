<?php

namespace Bagoesz21\LaravelSitemap;

use Illuminate\Support\Arr;

class SitemapConfig
{
    protected $config = [];

    /**
     * @return self
     */
    public static function make()
    {
        return (new self());
    }

    public function __construct()
    {

    }

    public function toArray()
    {
        return config('sitemap');
    }

    public function get($key, $default = null)
    {
        return Arr::get($this->toArray(), $key, $default);
    }
}
