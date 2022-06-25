<?php

return [
    'escape' => [
        'enabled' => true,

        /**
         * Escape entity (character / symbol)
         *
         * @see https://developers.google.com/search/docs/advanced/sitemaps/build-sitemap#general-guidelines
         */
        'chars' => [
            "<" => "&lt;",
            ">" => "&gt;",
            '"' => "&quot;",
            "'" => "&apos;",
            "&" => "&amp;",
        ]
    ],

    'limit' => 1000,

    /**
     * Sitemapable in model eloquent
     */
    'sitemapable' => [
        'app/Models'
    ],

    'queue' => [
        'enabled' => env('SITEMAP_QUEUE_ENABLED', false),
        'connection' => env('SITEMAP_QUEUE_CONNECTION', config('queue.default')),
    ],

    'store' => [
        'disk' => env('SITEMAP_STORE_DISK', config('filesystems.default')),
        'folder' => env('SITEMAP_STORE_FOLDER', 'sitemap'),
    ],

    'generator' => [
        'prefix' => 'sitemap',
    ],

    'cache' => [

        'enabled' => env('SITEMAP_CACHE_ENABLED', false),

        'cache_key' => 'sitemap-cache',

        /*
         * Supported: "file", "redis"
         */

        'store' => env('SITEMAP_CACHE_DRIVER', 'file'),
    ],
];
