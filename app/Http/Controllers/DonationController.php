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

use Mail;
use Validator;
use Redirect;
use View;
use Carbon\Carbon;
use Mollie;

class DonationController extends Controller
{
    public function newDonation(Request $request)
    {
        // For a new donation we need to fetch all donation types
        $donationTypes = DonationType::all()->groupBy('kind')->toArray();
        // Count the donationTypes; if none are available, show an error
        $disabled = false;
        if (count($donationTypes) < 1 && $request->project->currency == 0) {
            $disabled = true;
        }
        // We also need to check if monetary contributions are allowed
        $currency = $request->project->currency;
        // Return view
        return View::make('front.donation.start')
            ->with('currency', $currency)
            ->with('donationTypes', $donationTypes)
            ->with('donationsDisabled', $disabled)
            ->with('project', $request->project);
    }

    public function continueDonation(Request $request)
    {
        $validation = [];
        // Set up validation rules for incoming request
        $input = Input::all();

        // Get the fields that start with pledge_
        $fields = array_keys($input);
        foreach ($fields as $field) {
            // Check pledge fields: if the amount > 0
            if (strpos($field, "pledge_") === 0 && $input[$field] != "" && $input[$field] != 0) {
                $validation[$field] = "numeric|min:0";
            }
        }

        // Create validator
        $validator = Validator::make(
            Input::all(),
            $validation
        );

        // If validation fails... return errors
        if ($validator->fails()) {
            $errors = [
                trans('donation.errors.donations_invalid')
            ];
            return Redirect::back()->withErrors($errors);
        }

        // Build an array of types (will contain count, name, etc)
        $types = [];
        // Get input from form
        $input = Input::all();
        // Get the fields that start with pledge_
        $fields = array_keys($input);
        foreach ($fields as $field) {
            // Check pledge fields: if the amount > 0
            if (strpos($field, "pledge_") === 0 && $input[$field] != "" && $input[$field] != 0) {
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
        if (Input::get('currency') != "") {
            $types["currency"] = Input::get('currency');
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

        $currency = 0;
        if (array_key_exists("currency", $input["_pledge"])) {
            $currency = $input["_pledge"]["currency"];
        }

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
                    "currency" => $currency,
                    "secret_url" => $secret_url,
                    "confirm_url" => $confirm_url,
                    "confirmed" => null,
                    "message" => Input::get('message'),
                ]
            );

            foreach ($input['_pledge'] as $pledge) {
                if (is_array($pledge)) {
                    for ($i = 0; $i < $pledge['amount']; $i++) {
                        DonationItem::create(
                            [
                                "donation_id" => $donation->id,
                                "donation_type_id" => $pledge["id"]
                            ]
                        );
                    }
                }
            }

            if ($currency > 0) {
                $redirectUrl = Mollie::createPayment($donation->id);
                // Redirect the user
                return Redirect::to($redirectUrl);
            }

            $data = [
                "email" => Input::get('email'),
                "firstName" => Input::get('firstName'),
                "lastName" => Input::get('lastName'),
                "name" => Input::get('firstName') . " " . Input::get('lastName'),
                "projectTitle" => $request->project->title,
                "types" => $input['_pledge'],
                "confirm_url" => $donation->confirm_url
            ];

            Mail::queue('mails.donation_confirm', $data, function ($message) use ($data) {
                $message->to($data['email'], $data['name'])
                    ->subject(trans('mails.donation_confirm.subject') . " — " . $data['projectTitle']);
            });

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

    public function emailConfirmation(Request $request, $code, $email)
    {
        // Check if a donation can be found with this code and email
        $donation = Donation::where('confirm_url', $code)->where('email', $email)->first();
        if ($donation != null && $donation->confirmed == null) {
            $donation->confirmed = Carbon::now();
            $donation->save();

            // Send an email
            $data = [
                "email" => $email,
                "firstName" => $donation->first_name,
                "lastName" => $donation->last_name,
                "name" => $donation->first_name . " " . $donation->last_name,
                "projectTitle" => $request->project->title,
                "secret_url" => $donation->secret_url
            ];

            Mail::queue('mails.donation_success', $data, function ($message) use ($data) {
                $message->to($data['email'], $data['name'])
                    ->subject(trans('mails.donation_success.subject') . " — " . $data['projectTitle']);
            });

            // Notify the administrator
            // TODO: Notify the admin; collect the new pledge information

            // Return view
            return View::make('front.donation.confirmed');
        }
        return "This is not a valid confirmation mail or this was already confirmed.";
    }

    public function paymentStatus(Request $request, $donation_id)
    {
        $donation = Donation::find($donation_id);
        if ($donation->payment_status == "paid") {
            $data = [
                "email" => $donation->email,
                "firstName" => $donation->first_name,
                "lastName" => $donation->last_name,
                "name" => $donation->first_name . " " . $donation->last_name,
                "projectTitle" => $request->project->title,
                "secret_url" => $donation->secret_url
            ];
            Mail::queue('mails.donation_money_success', $data, function ($message) use ($data) {
                $message->to($data['email'], $data['name'])
                    ->subject(trans('mails.donation_money_success.subject') . " — " . $data['projectTitle']);
            });
            return View::make('front.donation.thanks')->with('paid', true);
        } else {
            return View::make('front.donation.payment_status')->with('paymentStatus', $donation->payment_status);
        }
    }

    public function paymentWebhook($donation_id)
    {
        Mollie::checkPayment($donation_id);
    }

}

