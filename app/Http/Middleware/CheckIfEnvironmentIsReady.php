<?php

namespace W4P\Http\Middleware;

use W4P\Models\Setting;

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
        // Check if the settings are invalid
        if (
            !Setting::exists('pwd') ||
            !Setting::exists('platform.name') ||
            !Setting::exists('project.title') ||
            !Setting::exists('project.brief') ||
            !Setting::exists('email.valid'))
        {
            // If the settings are invalid or incomplete, redirect to setup
            return redirect()->route('setup::index');
        }
        return $next($request);

    }
}
