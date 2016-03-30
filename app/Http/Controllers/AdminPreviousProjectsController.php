<?php

namespace W4P\Http\Controllers;

use Illuminate\Http\Request;

use W4P\Http\Requests;
use W4P\Models\ArchivedProject;

use View;
use Validator;
use Session;
use Redirect;

class AdminPreviousProjectsController extends Controller
{
    public function index()
    {
        // Get all tiers
        $archived = ArchivedProject::all();
        return View::make('backoffice.previous.index')->with('archived', $archived);
    }

    public function showImportForm()
    {
        
    }
}
