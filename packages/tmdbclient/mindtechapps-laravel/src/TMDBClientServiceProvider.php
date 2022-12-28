<?php

namespace TMDBClient\MindTechApps;

use Illuminate\Support\ServiceProvider;

class TMDBClientServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/tmdbclient.php' =>config_path('tmdbclient.php')
        ]);
    }

    public function register()
    {
        $this->app->singleton(TMDBClient::class);
    }
}
