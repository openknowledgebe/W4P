<?php

namespace W4P\Http\Controllers;

use Illuminate\Http\Request;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;
use W4P\Models\Setting;

use Redirect;
use View;
use W4P\Models\Project;

class HomeController extends Controller
{
    /**
     * Start point for the application
     * @return string
     */
    public function index()
    {
        return View::make('front.home')
            ->with("project", Project::get())
            ->with("data", Setting::getBeginsWith('organisation.'));
    }
}
