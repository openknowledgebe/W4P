<?php

namespace W4P\Http\Middleware;

use W4P\Models\Setting;

use Closure;

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
        if (
            Setting::exists('pwd') &&
            Setting::exists('platform.name') &&
            Setting::exists('project.title') &&
            Setting::exists('project.brief') &&
            Setting::exists('mail.valid')
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
