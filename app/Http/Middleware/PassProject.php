<?php

namespace W4P\Http\Middleware;

use W4P\Models\Setting;
use W4P\Models\Project;
use DB;

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
        // Put project in request
        $request->project = Project::first();

        // Archived count
        View::share('archived_count', DB::table('archivedproject')->count());

        // Get the project
        $project = $request->project;

        // Only execute this if project is valid or exists
        if ($project) {
            View::share('W4P_project', $request->project);
            View::share('video_id', $project->getVideoId());
            View::share('video_provider', $project->getVideoProvider());
        }

        return $next($request);
    }
}
