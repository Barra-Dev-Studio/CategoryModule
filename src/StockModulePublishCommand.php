<?php
/*
 * This file is part of the Stock Module package.
 *
 * (c) Khoerul Umam <id.khoerulumam@gmail.com>
 *
 */

namespace BarraDev\StockModule;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class StockModulePublishCommand extends Command
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'stockmodule:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish Stock Module assets from vendor packages';

    /**
     * Compatiblity for Lumen 5.5.
     *
     * @return void
     */
    public function handle()
    {
        $this->fire();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->publishModels();
        $this->publishMigrations();
        $this->publishService();
        $this->publishView();
        $this->publishAssets();
        $this->publishController();

        $this->info("Publishing Stock Module complete");
    }


    /**
     * Publish the directory to the given directory.
     *
     * @param  string  $from
     * @param  string  $to
     * @return void
     */
    protected function publishDirectory($from, $to)
    {
        $exclude = array('..', '.', '.DS_Store');
        $source = array_diff(scandir($from), $exclude);

        foreach ($source as $item) {
            $this->info("Copying file: " . $to . $item);
            File::copy($from . $item, $to . $item);
        }
    }

    /**
     * Publish model.
     *
     * @return void
     */
    protected function publishModels()
    {
        $targetPath = app()->path() . "/Models/";

        if (!File::isDirectory($targetPath)) {
            File::makeDirectory($targetPath, 0777, true, true);
        }

        $this->publishDirectory(__DIR__ . '/app/Models/', app()->path() . "/Models/");
    }

    /**
     * Publish migrations.
     *
     * @return void
     */
    protected function publishMigrations()
    {
        $this->publishDirectory(__DIR__ . '/database/Migrations/', app()->databasePath() . "/migrations/");
    }

    /**
     * Publish view.
     *
     * @return void
     */
    protected function publishView()
    {
        $targetPath = app()->resourcePath() . "/views/item";

        if (!File::isDirectory($targetPath)) {
            File::makeDirectory($targetPath, 0777, true, true);
        }

        $this->publishDirectory(__DIR__ . '/resources/views/item/', app()->resourcePath() . "/views/item/");
    }

    /**
     * Publish Service
     * 
     * @return
     */
    protected function publishService()
    {
        $targetPath = app()->path() . "/Services/";

        if (!File::isDirectory($targetPath)) {
            File::makeDirectory($targetPath, 0777, true, true);
        }

        $this->publishDirectory(__DIR__ . '/app/Services/', app()->path() . "/Services/");
    }

    /**
     * Publish Service
     * 
     * @return
     */
    protected function publishAssets()
    {
        $targetPath = app()->publicPath() . "/assets/js/";

        if (!File::isDirectory($targetPath)) {
            File::makeDirectory($targetPath, 0777, true, true);
        }

        $this->publishDirectory(__DIR__ . '/public/assets/js/', app()->publicPath() . "/assets/js/");
    }

    /**
     * Publish Service
     * 
     * @return
     */
    protected function publishController()
    {
        $this->publishDirectory(__DIR__ . '/app/Http/Controllers/', app()->path() . "/Http/Controllers/");
    }
}
