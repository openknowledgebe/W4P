<?php

namespace W4P\Http\Controllers;

use Illuminate\Http\Request;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;

use View;

class AdminController extends Controller
{
    public function dashboard()
    {
        return View::make('backoffice.dashboard');
    }
}
