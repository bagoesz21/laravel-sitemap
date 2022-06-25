<?php

namespace Bagoesz21\LaravelSitemap\Sitemapable;

interface Sitemapable
{
    /**
     * Config sitemap
     *
     * @return array
     */
    public function configSitemap(): array;

    /**
    * Query sitemap
    *
    * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder|bool
    */
    public function querySitemap();

    /**
     * Transform data before build sitemap
     *
     * @param array $datas
     * @return mixed
     */
    public function transformSitemap(array $datas);
}
