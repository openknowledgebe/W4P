<?php

namespace W4P\Http\Middleware;

use W4P\Models\Setting;
use W4P\Models\Project;

use Closure;
use View;

class PassProject
{
    /**
     * This middleware will pass the project object into the request, ensuring that the
     * project doesn't need to be queried anymore.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->project = Project::first();
        View::share('W4P_project', $request->project);
        return $next($request);
    }
}
