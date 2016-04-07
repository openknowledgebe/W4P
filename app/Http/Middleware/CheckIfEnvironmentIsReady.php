<?php

namespace W4P\Http\Middleware;

use W4P\Models\Setting;
use W4P\Models\Project;

use Closure;
use View;
use Session;

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

        // We'll store whether mollie is used here
        $mollie = false;

        if (!array_key_exists('pwd', $settings) ||
            !array_key_exists('platform.name', $settings) ||
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
        }

        if (array_key_exists('platform.mollie-key', $settings)) {
            // Check if the Mollie key is empty
            if ($settings['platform.mollie-key'] != null && $settings['platform.mollie-key'] != "") {
                $mollie = true;
                if (!array_key_exists('organisation.address', $settings) ||
                    !array_key_exists('organisation.vat', $settings) ||
                    !array_key_exists('organisation.email', $settings)
                ) {
                    Session::flash('info', trans('setup.warnings.mollie'));
                    if (!array_key_exists('setup.complete', $settings)) {
                        return redirect()->route('setup::step', 3);
                    }
                }
            }
        }

        if (!Project::valid($request->project) ||
            !array_key_exists('setup.complete', $settings) ||
            !array_key_exists('email.valid', $settings)
        ) {
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
         * (freely accessible)
         *===============*/

        $keys = ["platform.copyright", "organisation.name", "social.twitter_handle",
            "social.twitter_message", "social.facebook_page_url", "social.facebook_message",
            "social.seo_title", "social.seo_description", "social.seo_image"];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $settings)) {
                $settings[$key] = null;
            } else {
                if ($settings[$key] == "") {
                    $settings[$key] = null;
                }
            }
        }

        $public_settings = [
            "copyright" => $settings["platform.copyright"],
            "org" => $settings["organisation.name"],
            "social" => (object)[
                "twitter_handle" => $settings["social.twitter_handle"],
                "twitter_message" => $settings["social.twitter_message"],
                "facebook_page_url" => $settings["social.facebook_page_url"],
                "facebook_message" => $settings["social.facebook_message"],
                "seo_title" => $settings["social.seo_title"],
                "seo_description" => $settings["social.seo_description"],
                "seo_image" => $settings["social.seo_image"]
            ],
        ];

        if ($mollie && array_key_exists('organisation.address', $settings) &&
        array_key_exists('organisation.vat', $settings) &&
        array_key_exists('organisation.email', $settings)) {
            $public_settings["legal"] = (object)[
                'address' => $settings["organisation.address"],
                'vat' => $settings["organisation.vat"],
                'email' => $settings["organisation.email"],
            ];
        }

        // Share in request
        $request->settings = $public_settings;

        // Share in view
        View::share('settings', (object)$public_settings);

        /*================
        * PASS REQUEST
        *===============*/

        return $next($request);
    }
}
