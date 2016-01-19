<?php

namespace W4P\Http\Controllers;

use Illuminate\Http\Request;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;
use W4P\Models\Tier;
use View;

class AdminTierController extends Controller
{
    public function index()
    {
        // Get all tiers
        $tiers = Tier::all()->sortBy('pledge');
        return View::make('backoffice.tiers.index')->with('tiers', $tiers);
    }
}
