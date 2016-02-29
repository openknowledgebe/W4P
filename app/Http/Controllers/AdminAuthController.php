<?php

namespace W4P\Http\Controllers;

use Illuminate\Http\Request;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use View;

use W4P\Models\Setting;

class AdminAuthController extends Controller
{
    /**
     * GET
     * Shows login page
     */
    public function login()
    {
        return View::make('backoffice.login');
    }

    /**
     * POST
     * Logs the user in
     */
    public function doLogin()
    {
        // Check if the credentials are correct, otherwise redirect back
        $password = Input::get('password');

        if (Hash::check($password, Setting::get('pwd'))) {
            // Generate a random token
            $token = str_random(50);

            // Set a random token in the session
            Session::put('token', $token);
            Setting::set('token', $token);

            // Redirect to the index (dashboard)
            return Redirect::route('admin::index');

        } else {
            return Redirect::back()->withErrors(["This password is incorrect."]);
        }
    }
}
