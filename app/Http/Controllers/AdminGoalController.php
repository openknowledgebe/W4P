<?php

namespace W4P\Http\Controllers;

use Illuminate\Http\Request;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;

use W4P\Models\DonationType;
use W4P\Models\DonationKind; // fake model

use View;

class AdminGoalController extends Controller
{
    public function index()
    {
        $donationTypes = DonationType::all()->groupBy('kind');
        $donationKinds = DonationKind::all();
        return View::make('backoffice.goals.index')
            ->with('donationTypes', $donationTypes)
            ->with('donationKinds', $donationKinds);
    }

    public function kind($kind)
    {
        $donationTypes = DonationType::where('kind', $kind)->get();
        return View::make('backoffice.goals.kind')
            ->with('donationTypes', $donationTypes)
            ->with('kind', $kind);
    }
}
