<?php

namespace W4P\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\ServiceProvider;
use W4P\Models\Setting;
use EmailConfig;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Load email settings
        EmailConfig::loadFromDb();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        \App::bind('emailconfig', function () {
            return new \W4P\Helpers\EmailConfig;
        });
    }
}
