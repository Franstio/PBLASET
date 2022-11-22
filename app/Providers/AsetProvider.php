<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AsetBarangService;
use App\Services\AsetGedungService;
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
        $this->app->bind(AsetGedungService::class,function($app){
            return new AsetGedungService();
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
