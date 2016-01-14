<?php

namespace W4P\Providers;

use Illuminate\Support\Facades\Config;

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

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
