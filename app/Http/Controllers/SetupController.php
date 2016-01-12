<?php

namespace W4P\Http\Controllers;

use Illuminate\Http\Request;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;
use View;

class SetupController extends Controller
{
    /**
     * Shows the initial setup page when setting up the W4P environment.
     * @return string
     */
    public function index()
    {
        return View::make('setup.welcome');
    }

    /**
     * Shows a specific page
     * @param int $number The step we want to see in the wizard.
     * @return mixed
     */
    public function showStep($number)
    {
        return View::make('setup.step' . $number)
            ->with('step', $number);
    }
}
