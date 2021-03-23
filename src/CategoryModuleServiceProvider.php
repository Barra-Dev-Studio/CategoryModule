<?php

/*
 * This file is part of the Category Module package.
 *
 * (c) Khoerul Umam <id.khoerulumam@gmail.com>
 *
 */

namespace BarraDev\CategoryModule;

use Illuminate\Support\ServiceProvider;
use BarraDev\CategoryModule\CategoryModulePublishCommand;

/**
 * Category Module Service Provider
 */
class CategoryModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CategoryModulePublishCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
