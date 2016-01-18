<?php

namespace W4P\Http\Controllers;

use Illuminate\Http\Request;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;
use W4P\Models\Setting;

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
    public function index()
    {
        // Get the project
        $project = Project::get();

        // Get when the project runs out
        $ends_at = new Carbon($project->ends_at);
        $now = Carbon::now();
        // TODO: diffForHumans should support multiple locales, verify if this is correct without extra work!
        $left = $now->diffForHumans($ends_at);

        // Return the view with all the text
        return View::make('front.home')
            ->with("project", Project::get())
            ->with("data", Setting::getBeginsWith('organisation.'))
            ->with("left", $left);
    }
}
