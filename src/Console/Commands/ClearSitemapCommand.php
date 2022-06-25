<?php

namespace Bagoesz21\LaravelSitemap\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;

use Bagoesz21\LaravelSitemap\SitemapDelete;

class ClearSitemapCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = '';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear generated sitemap files';

    /** @var \Bagoesz21\LaravelSitemap\SitemapDelete */
    protected $sitemap;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->signature = "sitemap:clear
                            {sitemap?* : Sitemap}
                            {--queue= : queue driver}
                            {--al|all : delete all generated sitemap}";

        parent::__construct();

        $this->sitemap = SitemapDelete::make();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info("Please wait delete sitemap in folder " . $this->sitemap->getDiskPath());

        $all = $this->option('all');
        $sitemapName = $this->argument('sitemap');

        $all = ($all || empty($sitemapName));

        if($all){
            $this->info("Delete all sitemap ..");
            $this->sitemap->deleteAllSitemap();
        }else{
            $sitemapName = $this->argument('sitemap');
            $mergeSitemapName = implode(", ", Arr::wrap($sitemapName));
            $this->info("Delete all sitemap ($mergeSitemapName) ..");
            $this->sitemap->clearSitemap($sitemapName);
        }
        $this->info("Delete sitemap completed.");
    }
}
