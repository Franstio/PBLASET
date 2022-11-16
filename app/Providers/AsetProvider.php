<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AsetBarangService;
use App\Services\SatkerService;

class AsetProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(AsetBarangService::class,function($app){
            return new AsetBarangService();
        });
        $this->app->bind(SatkerService::class,function ($app){
            return new SatkerService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
