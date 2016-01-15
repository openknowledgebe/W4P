<?php

namespace W4P\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\ServiceProvider;
use W4P\Models\Setting;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadEmailSettingsFromDatabase();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Loads email settings from the database, if possible
     */
    private function loadEmailSettingsFromDatabase()
    {
        // This script will run even before migrations occur when running PHPUnit, so we need
        // to check if the settings table exists. If it does, try to load the preferred mail settings
        // over the ENV-provided mail settings.

        if (Schema::hasTable('settings')) {
            // Load configuration from database
            $values = Setting::where('key', 'LIKE', '%email.%')->get()->toArray();
            $settings = [];
            foreach ($values as $kvp) {
                $settings[$kvp['key']] = $kvp['value'];
            }
            $check = ["host", "port", "encryption", "username", "password"];
            foreach ($check as $value) {
                if (array_key_exists("email." . $value, $settings)) {
                    if ($settings["email." . $value] == "") {
                        Config::set('mail.' . $value, null);
                    } else {
                        Config::set('mail.' . $value, $settings["email." . $value]);
                    }
                }
            }
            if (array_key_exists("email.from", $settings) && array_key_exists("email.name", $settings)) {
                $array = ['address' => $settings['email.from'], 'name' => $settings['email.name']];
                Config::set('mail.from', $array);
            }
        }
    }
}
