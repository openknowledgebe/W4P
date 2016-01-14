<?php

namespace W4P\Http\Controllers;

use Illuminate\Http\Request;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;

class AdminAuthController extends Controller
{
    /**
     * GET
     */
    public function login()
    {
        // TODO: Make view for login form and return it here
        return "Login form here";
    }

    /**
     * POST
     */
    public function doLogin()
    {
        // TODO: Handle authentication here, also do validation
        // TODO: Redirect if correctly logged in to the dashboard
        return "Submit login form here";
    }
}
