<?php

namespace Bagoesz21\LaravelSitemap;

use Illuminate\Support\Facades\Storage;

trait HasDisk
{
    /**
     * @return \Illuminate\Filesystem\FilesystemAdapter
     */
    public function getDisk()
    {
        return Storage::disk($this->config->get('store.disk'));
    }

    /**
     * @param string|null $path
     * @return string
     */
    public function getDiskPath($path = null)
    {
        $paths[] = $this->config->get('store.folder');
        if(!is_null($path)){
            $paths[] = $path;
        }

        $paths = array_filter($paths);
        $path = implode("/", $paths);

        return $this->getDisk()->path($path);
    }
}
