<?php

namespace Bagoesz21\LaravelSitemap;

use Bagoesz21\LaravelSitemap\SitemapConfig;

class SitemapGenerator
{
    use HasDisk;

    protected $sitemap;

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
     * Reset
     *
     * @return void
     */
    public function reset()
    {

    }

    /**
     * Generate sitemap now or queued
     *
     * @return bool
     */
    public function generate(){
        $this->reset();

        if($this->config->get('queue.enabled')){
            $this->generateQueued();
        } else {
            $this->generateNow();
        }
        return true;
    }

    /**
     * Generate sitemap with queue
     *
     * @return bool
     */
    protected function generateQueued(){
        if(!$this->sitemap->query())return;

        $totalData = $this->sitemap->query()->count();

        $limit = $this->config->get('limit');
        $totalPage = (int)ceil($totalData / $limit);
        if($totalPage < 1)return false;

        $sitemapJob = [];
    }
}
