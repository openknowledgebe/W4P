<?php

namespace W4P\Http\Middleware;

use W4P\Models\Setting;
use W4P\Models\Project;

use Closure;
use View;

class CheckIfEnvironmentIsReady
{
    /**
     * This middleware will redirect to the setup if the initial configuration hasn't
     * been completed before.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*================
        * GET SETTINGS
        *===============*/

        $settings = [];
        $allSettings = Setting::all();
        foreach ($allSettings as $setting) {
            $settings[$setting->key] = $setting->value;
        }

        /*================
        * CHECK VALID CONF
        *===============*/

        if (!array_key_exists('pwd', $settings) ||
            !array_key_exists('platform.name', $settings) ||
            !array_key_exists('email.valid', $settings) ||
            !array_key_exists('organisation.valid', $settings) ||
            !Project::valid($request->project) ||
            !array_key_exists('setup.complete', $settings)
        ) {
            if (!array_key_exists('pwd', $settings)) {
                return redirect()->route('setup::index');
            }
            if (!array_key_exists('platform.name', $settings)) {
                return redirect()->route('setup::step', 2);
            }
            if (!array_key_exists('organisation.valid', $settings)) {
                return redirect()->route('setup::step', 3);
            }
            if (!Project::valid($request->project)) {
                return redirect()->route('setup::step', 4);
            }
            if (!array_key_exists('email.valid', $settings)) {
                return redirect()->route('setup::step', 5);
            }
            if (!array_key_exists('setup.complete', $settings)) {
                return redirect()->route('setup::step', 6);
            }
            // If the settings are invalid or incomplete, redirect to setup
            return redirect()->route('setup::index');
        }

        /*================
         * PUBLIC SETTINGS
         *===============*/

        if (!array_key_exists('platform.copyright', $settings)) {
            $settings["platform.copyright"] = "";
        }
        if (!array_key_exists('organisation.name', $settings)) {
            $settings["organisation.name"] = "";
        }

        $public_settings = [
            "copyright" => $settings["platform.copyright"],
            "org" => $settings["organisation.name"]
        ];

        View::share('settings', $public_settings);

        /*================
        * PASS REQUEST
        *===============*/

        return $next($request);
    }
}
