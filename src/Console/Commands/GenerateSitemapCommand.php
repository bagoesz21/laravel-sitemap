<?php

namespace Bagoesz21\LaravelSitemap\Console\Commands;

use Illuminate\Console\Command;

use Bagoesz21\LaravelSitemap\SitemapGenerator;

class GenerateSitemapCommand extends Command
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
    protected $description = 'Generate sitemap files';

    /** @var \Bagoesz21\LaravelSitemap\SitemapGenerator */
    protected $sitemap;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->signature = "sitemap:generate
                            {sitemap?* : Sitemap}
                            {--Q|queued : generate with queue}
                            {--al|all : generate all sitemap}";

        parent::__construct();

        $this->generator = SitemapGenerator::make();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info("Please wait generate sitemap from database ..");
        $this->info("Store sitemap in folder " . $this->sitemap->getDiskPath());

        $all = $this->option('all');
        $sitemapName = $this->argument('sitemap');
        $all = ($all || empty($sitemapName));

        $queued = $this->option('queued');

        if($queued){
            $this->info("Generate sitemap on queued, please wait.");
        } else {
            $this->info("Generate sitemap completed.");
        }
    }
}
