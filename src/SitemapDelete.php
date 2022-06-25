<?php

namespace Bagoesz21\LaravelSitemap;

use Bagoesz21\LaravelSitemap\SitemapConfig;

class SitemapDelete
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
     * Get all generated sitemap files in disk
     *
     * @return array $files
    */
    public function getAllSitemapName()
    {
        $files = $this->getDisk()->files( $this->config->get('store.folder') );
        $prefix = $this->config->get('generator.prefix');
        $files = preg_grep("/^$prefix/i", $files);
        return $files;
    }

    /**
     * Batch delete sitemaps.
     *
     * @param array|string $files. sitemap filename
     * @return \Illuminate\Support\Facades\Storage|bool
    */
    public function deleteSitemap($files)
    {
        if(empty($files))return false;
        $files = (!is_array($files)) ? [$files] : $files;

        return $this->getDisk()->delete($files);
    }

    /**
     * Delete all sitemaps.
     *
     * @return \Illuminate\Support\Facades\Storage
    */
    public function deleteAllSitemap()
    {
        $files = $this->getAllSitemapName();

        return $this->deleteSitemap($files);
    }

    /**
     * Batch delete generated sitemap files. Including sitemap index & sitemap number.
     *
     * @param array $batchSitemapName. sitemap key
     * @return bool
    */
    public function clearSitemap($batchSitemapName)
    {
        if(empty($batchSitemapName))return false;

        foreach ($batchSitemapName as $key => $sitemapName) {
            $sitemapName = trim($sitemapName);
            if(!in_array($sitemapName, $this->getSitemapKeys()))continue;

            $filenameSitemap = $this->getValueConfigSitemap($sitemapName, 'name');

            $this->deleteSitemapNumberAndIndex($filenameSitemap);
        }
        return true;
    }

    /**
     * Delete sitemap index & sitemap number.
     *
     * @param string $filenameSitemap. sitemap filename without extension
     * @return \Illuminate\Support\Facades\Storage|bool
    */
    protected function deleteSitemapNumberAndIndex($filenameSitemap)
    {
        if(empty($filenameSitemap))return false;

        $files = $files = $this->getAllSitemapName();
        $files = preg_grep("/^".$filenameSitemap."-[0-9]/i", $files);
        $files[] = $this->fileNameSitemap($filenameSitemap);

        return $this->deleteSitemap($files);
    }
}
