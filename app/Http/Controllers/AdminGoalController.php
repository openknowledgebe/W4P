<?php

namespace W4P\Http\Controllers;

use Illuminate\Http\Request;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use W4P\Models\Donation;
use W4P\Models\DonationType;
use W4P\Models\DonationKind; // fake model
use W4P\Models\Setting;

use View;
use Validator;
use Session;
use Redirect;

class AdminGoalController extends Controller
{

    public function weights(Request $request)
    {
        $donationKinds = DonationKind::all();
        $weights = Setting::getBeginsWith('weight.');
        return View::make('backoffice.goals.weights')
            ->with('donationKinds', $donationKinds)
            ->with('weights', $weights);
    }

    public function saveWeights(Request $request)
    {

        // Validation rules
        $kinds = DonationKind::all();
        $rules = [];
        foreach ($kinds as $kind) {
            $rules['weight_' . $kind] = 'required|min:0|integer';
        }

        // Validate
        $validator = Validator::make(
            Input::all(),
            $rules
        );

        // Check if the validator fails
        if (!$validator->fails()) {
            foreach ($kinds as $kind) {
                Setting::set('weight.' . $kind, Input::get('weight_' . $kind));
            }
            return Redirect::route('admin::goalsWeight');
        } else {
            $errors = $validator->messages();
            return Redirect::back()->withErrors($errors)->withInput(Input::all());
        }
    }

    /**
     * Get a list of all categories and a count of subcategories
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $donationTypes = DonationType::all()->groupBy('kind');
        $donationKinds = DonationKind::all();
        return View::make('backoffice.goals.index')
            ->with('donationTypes', $donationTypes)
            ->with('donationKinds', $donationKinds)
            ->with('currency', $request->project->currency);
    }

    /**
     * Get an overview of all subcategories for a particular kind of category
     * @param $kind
     * @return mixed
     */
    public function kind($kind)
    {
        $donationTypes = DonationType::where('kind', $kind)->get();
        return View::make('backoffice.goals.kind')
            ->with('donationTypes', $donationTypes)
            ->with('kind', $kind);
    }

    /**
     * Create a new type (subcategory)
     * @param $kind
     * @return mixed
     */
    public function createType($kind)
    {
        return View::make('backoffice.goals.type_edit')
            ->with('new', true)
            ->with('kind', $kind);
    }

    /**
     * Edit an existing type (subcategory)
     * @param $kind
     * @param $id
     * @return mixed
     */
    public function editType($kind, $id)
    {
        $donationType = DonationType::where('kind', $kind)->where('id', $id)->first();
        return View::make('backoffice.goals.type_edit')
            ->with('new', false)
            ->with('kind', $kind)
            ->with('id', $id)
            ->with('data', $donationType->toArray());
    }

    /**
     * Store a type (subcategory)
     * @param $kind
     * @return mixed
     */
    public function storeType($kind)
    {
        $success = true;
        $errors = [];

        // Validate
        $validator = Validator::make(
            Input::all(),
            [
                'name' => 'required|min:4',
                'description' => 'required|min:4',
                'unit_description' => 'required|min:4',
                'required_amount' => 'required|min:1|numeric',
            ]
        );

        // Check if the validator fails
        if (!$validator->fails()) {
            // Save the tier
            $data = Input::all();
            $data['kind'] = $kind;
            DonationType::create($data);
            Session::flash('info', trans('backoffice.flash.goal_save_success'));
        } else {
            // Validation has failed. Set success to false. Set validator messages
            $success = false;
            $errors = $validator->messages();
        }

        if ($success) {
            return Redirect::route('admin::goalsDetail', $kind);
        } else {
            return Redirect::back()->withErrors($errors)->withInput(Input::all());
        }
    }

    /**
     * Update an existing type (subcategory)
     * @param $kind
     * @param $id
     * @return mixed
     */
    public function updateType($kind, $id)
    {
        $success = true;
        $errors = [];

        // Validate
        $validator = Validator::make(
            Input::all(),
            [
                'name' => 'required|min:4',
                'description' => 'required|min:4',
                'unit_description' => 'required|min:4',
                'required_amount' => 'required|min:1|numeric',
            ]
        );

        // Check if the validator fails
        if (!$validator->fails()) {
            // Save the tier
            DonationType::find($id)->update(Input::all());

        } else {
            // Validation has failed. Set success to false. Set validator messages
            $success = false;
            $errors = $validator->messages();
        }

        if ($success) {
            Session::flash('info', trans('backoffice.flash.goal_update_success'));
            return Redirect::route('admin::goalsDetail', $kind);
        } else {
            return Redirect::back()->withErrors($errors)->withInput(Input::all());
        }
    }

    /**
     * Delete an existing type (subcategory)
     * @param $kind
     * @param $id
     * @return mixed
     */
    public function deleteType($kind, $id)
    {
        DonationType::find($id)->delete();
        return Redirect::route('admin::goalsDetail', $kind);
    }

    /**
     * Go to the currency page to set up the goals
     * @param Request $request
     * @return mixed
     */
    public function currency(Request $request)
    {
        $errors = [];
        if (Setting::get('platform.mollie-key') == "" || Setting::get('platform.mollie-key') == null) {
            $errors = [
                "Your have not set up a Mollie API key, so payments will NOT work until you set up an API key."
            ];
        }
        return View::make('backoffice.goals.currency')
            ->with('currency', $request->project->currency)
            ->withErrors($errors);
    }

    /**
     * Save the currency page
     * @param Request $request
     * @return mixed
     */
    public function updateCurrency(Request $request)
    {
        $success = true;
        $errors = [];

        $validator = Validator::make(
            [
                "currency" => Input::get('currency')
            ],
            [
                "currency" => 'required|numeric',
            ]
        );

        // Check if the validator fails
        if (!$validator->fails()) {
            // Save the tier
            $request->project->update([
                "currency" => Input::get('currency')
            ]);
        } else {
            // Validation has failed. Set success to false. Set validator messages
            $success = false;
            $errors = $validator->messages();
        }

        if ($success) {
            Session::flash('info', trans('backoffice.flash.currency_update_success'));
            return Redirect::route('admin::goalsCurrency');
        } else {
            return Redirect::back()->withErrors($errors)->withInput(Input::all());
        }
    }
}
