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

        // Get the project
        $project = $request->project;

        // Extract the video url
        $videoId = "";

        $videoProvider = null;
        if (strpos($project->video_url, 'watch?v=') !== false) {
            $videoProvider = "youtube";
        }
        if (strpos($project->video_url, 'vimeo.com/') !== false) {
            $videoProvider = "vimeo";
        }

        // Check the video provider
        switch ($videoProvider) {
            case "vimeo":
                $array = explode("vimeo.com/", $project->video_url);
                $videoId = explode("/", last($array))[0];
                break;
            case "youtube":
                $array = explode("watch?v=", $project->video_url);
                $videoId = explode("&", last($array))[0];
                break;
            default:
                break;
        }

        View::share('W4P_project', $request->project);
        View::share('video_id', $videoId);
        View::share('video_provider', $videoProvider);

        return $next($request);
    }
}
