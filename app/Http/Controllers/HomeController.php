<?php

namespace W4P\Http\Controllers;

use Illuminate\Http\Request;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;
use W4P\Models\Setting;

use Redirect;

class HomeController extends Controller
{
    /**
     * Start point for the application
     * @return string
     */
    public function index()
    {
        if (Setting::exists('configured')) {
            return "Your environment is ready.";
        } else {
            return Redirect::to('/setup');
        }
    }
}
