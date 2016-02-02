<?php

namespace W4P\Http\Controllers;

use Illuminate\Http\Request;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use W4P\Models\DonationType;
use W4P\Models\DonationItem;
use W4P\Models\DonationKind;

use View;

class DonationController extends Controller
{
    public function newDonation(Request $request)
    {
        // For a new donation we need to fetch all donation types
        $donationTypes = DonationType::all()->groupBy('kind')->toArray();
        // We also need to check if monetary contributions are allowed
        $currency = $request->project->currency;
        // Return view
        return View::make('front.donation.start')
            ->with('currency', $currency)
            ->with('donationTypes', $donationTypes);
    }

    public function continueDonation(Request $request)
    {
        // TODO: Add validation
        // Get all donation types
        $donationTypes = DonationType::all()->toArray();
        // Build an array of types (will contain count, name, etc)
        $types = [];
        // Get input from form
        $input = Input::all();
        // Get the fields that start with pledge_
        $fields = array_keys($input);
        foreach ($fields as $field) {
            if (strpos($field, "pledge_") === 0) {
                $id = explode("pledge_", $field)[1];
                $donationType = DonationType::find($id);
                $type = [
                    "id" => $id,
                    "amount" => $input[$field],
                    "name" => $donationType->name,
                    "kind" => $donationType->kind
                ];
                array_push($types, $type);
            }
        }
        return View::make('front.donation.user')->with('types', $types);
    }

    public function confirmDonation(Request $request)
    {
        // TODO: Add validation
        $input = Input::all();
        $input['_pledge'] = json_decode(Input::get('_pledge'), 1);

        dd($input);
    }
}
