<?php

namespace W4P\Http\Middleware;

use W4P\Models\Setting;
use W4P\Models\Project;

use Closure;

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
        $settings = [];
        $allSettings = Setting::all();
        foreach ($allSettings as $setting) {
            $settings[$setting->key] = $setting->value;
        }
        // Check if the settings are invalid
        if (
            !array_key_exists('pwd', $settings) ||
            !array_key_exists('platform.name', $settings) ||
            !array_key_exists('email.valid', $settings) ||
            !array_key_exists('organisation.valid', $settings) ||
            !Project::valid($request->project)
        )
        {
            // If the settings are invalid or incomplete, redirect to setup
            return redirect()->route('setup::index');
        }
        return $next($request);

    }
}
