<?php

namespace Bagoesz21\LaravelSitemap;

use Bagoesz21\LaravelSitemap\SitemapConfig;

class Formatter
{
    /** @var \Bagoesz21\LaravelSitemap\SitemapConfig */
    protected $config;

    public function __construct()
    {
        $this->config = SitemapConfig::make();
    }

    /**
     * @return static
     */
    public static function make(){
        $class = get_called_class();
        return (new $class());
    }

    /**
     * Escape entities
     *
     * @param string $string.
     * @return string
    */
    public function escapeEntities($string) {
        return strtr($string, $this->config->get('escape.chars', []));
    }

    /**
     * Sanitize string. Trim string & escape entities.
     *
     * @param string $str.
     * @return string
    */
    public function clean($str){
        return $this->escapeEntities(trim($str));
    }
}
