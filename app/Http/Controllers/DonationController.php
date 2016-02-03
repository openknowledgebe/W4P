<?php

namespace W4P\Http\Controllers;

use Illuminate\Http\Request;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use W4P\Models\DonationType;
use W4P\Models\DonationItem;
use W4P\Models\DonationKind;
use W4P\Models\Donation;

use Validator;
use Redirect;
use View;

class DonationController extends Controller
{
    public function newDonation(Request $request)
    {
        // For a new donation we need to fetch all donation types
        $donationTypes = DonationType::all()->groupBy('kind')->toArray();
        // Count the donationTypes; if none are available, show an error
        $disabled = false;
        if (count($donationTypes) < 1) {
            $disabled = true;
        }
        // We also need to check if monetary contributions are allowed
        $currency = $request->project->currency;
        // Return view
        return View::make('front.donation.start')
            ->with('currency', $currency)
            ->with('donationTypes', $donationTypes)
            ->with('donationsDisabled', $disabled);
    }

    public function continueDonation(Request $request)
    {
        // Build an array of types (will contain count, name, etc)
        $types = [];
        // Get input from form
        $input = Input::all();
        // Get the fields that start with pledge_
        $fields = array_keys($input);
        foreach ($fields as $field) {
            // Check pledge fields: if the amount > 0
            if (strpos($field, "pledge_") === 0 && $input[$field] != "") {
                $id = explode("pledge_", $field)[1];
                $donationType = DonationType::find($id);
                // Build an array with information
                $type = [
                    "id" => $id,
                    "amount" => $input[$field],
                    "name" => $donationType->name,
                    "kind" => $donationType->kind
                ];
                array_push($types, $type);
            }
        }
        if (count($types) == 0) {
            // Fail validation
            $errors = [
                trans('donation.errors.no_donations_made')
            ];
            return Redirect::back()->withErrors($errors)->withInput(Input::all());
        }
        return View::make('front.donation.user')->with('types', $types);
    }

    public function confirmDonation(Request $request)
    {
        // Default outcome for this request
        $success = true;
        $errors = [];

        // Get all the input
        $input = Input::all();
        // Decode the pledge information
        $input['_pledge'] = json_decode(Input::get('_pledge'), 1);

        // TODO: Extract pledge information about payment

        // Validate the fields: name and email are required
        $validator = Validator::make(
            Input::all(),
            [
                'firstName' => 'required|min:1',
                'lastName' => 'required|min:1',
                'email' => 'required|email',
            ]
        );

        if (!$validator->fails()) {

            // Create a new donation
            $secret_url = str_random(40);
            $confirm_url = str_random(40);

            $donation = Donation::create(
                [
                    "first_name" => Input::get('firstName'),
                    "last_name" => Input::get('lastName'),
                    "email" => Input::get('email'),
                    "currency" => 0,
                    "secret_url" => $secret_url,
                    "confirm_url" => $confirm_url,
                    "confirmed" => null,
                    "message" => Input::get('message'),
                ]
            );

            foreach ($input['_pledge'] as $pledge) {
                for ($i = 0; $i < $pledge['amount']; $i++) {
                    DonationItem::create(
                        [
                            "donation_id" => $donation->id,
                            "donation_type_id" => $pledge["id"]
                        ]
                    );
                }
            }

            // TODO: Send an email to everyone (backer + project owner)

        } else {
            $success = false;
            $errors = $validator->messages();
        }

        if ($success) {
            return View::make('front.donation.thanks')
                ->with('types', $input['_pledge'])
                ->withInput($input);
        } else {
            return View::make('front.donation.user')
                ->with('types', $input['_pledge'])
                ->withErrors($errors)
                ->withInput($input);
        }
    }
}
