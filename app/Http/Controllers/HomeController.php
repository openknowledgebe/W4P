<?php

namespace W4P\Http\Controllers;

use Illuminate\Http\Request;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;

use W4P\Models\Setting;
use W4P\Models\Tier;
use W4P\Models\Post;

use Redirect;
use View;
use W4P\Models\Project;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Start point for the application
     * @return string
     */
    public function index(Request $request)
    {
        // Get the project
        $project = $request->project;

        // Extract the video url
        $videoId = "";

        // Check the video provider
        switch ($project->videoProvider) {
            case "vimeo":
                $array = explode("vimeo.com/", $project->videoUrl);
                $string = last($array);
                $array = explode("/", $string);
                $string = $array[0];
                // split on "vimeo.com/"
                // and again on "/"
                $videoId = $string;
                break;
            case "youtube":
                $array = explode("watch?v=", $project->videoUrl);
                $string = last($array);
                $array = explode("&", $string);
                $string = $array[0];
                // split on "watch?v="
                // and again on "&"
                $videoId = $string;
                break;
            default:
                break;
        }

        $posts = Post::orderBy('created_at', 'DESC')->limit(5)->get();

        // Get when the project runs out
        $ends_at = new Carbon($project->ends_at);
        $now = Carbon::now();
        $leftDays = $now->diffInDays($ends_at);
        $leftHours = $now->diffInHours($ends_at);

        // Return the view with all the text
        return View::make('front.home')
            ->with("project", $project)
            ->with("posts", $posts)
            ->with("video_id", $videoId)
            ->with("data", Setting::getBeginsWith('organisation.'))
            ->with("tiers", Tier::all()->sortBy('pledge'))
            ->with("hoursleft", $leftHours)
            ->with("daysleft", $leftDays);
    }
}
