<?php

namespace W4P\Http\Controllers;

use Illuminate\Http\Request;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;

use View;
use W4P\Models\Setting;

class AdminController extends Controller
{
    public function dashboard()
    {
        return View::make('backoffice.dashboard');
    }

    public function project()
    {
        $data = [];
        $data['project'] = Setting::getBeginsWith('project.');
        return View::make('backoffice.project')
            ->with('data', $data);
    }
}
