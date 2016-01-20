<?php

namespace W4P\Http\Middleware;

use W4P\Models\Setting;

use Closure;
use W4P\Models\Project;

class CheckSetupInaccessible
{
    /**
     * This middleware will redirect from any setup route back to the homepage if the setup
     * was already cleared before.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $settings = [];
        $allSettings = Setting::all();
        foreach ($allSettings as $setting) {
            $settings[$setting->key] = $setting->value;
        }
        // Check if the settings are valid
        if (
            array_key_exists('pwd', $settings) &&
            array_key_exists('platform.name', $settings) &&
            array_key_exists('email.valid', $settings) &&
            array_key_exists('organisation.valid', $settings) &&
            array_key_exists('setup.complete', $settings) &&
            Project::valid($request->project)
        )
        {
            // If the settings are valid, check if the URL isn't setup
            if (str_contains($request->route()->getName(), 'setup::')) {
                return redirect()->route('home');
            }
        }
        return $next($request);
    }
}
