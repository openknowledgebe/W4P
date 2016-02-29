<?php

namespace W4P\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;
use W4P\Models\Donation;
use W4P\Models\Tier;

use Session;
use Validator;
use Redirect;
use View;

class AdminTierController extends Controller
{
    /**
     * Get all tiers
     * @return mixed
     */
    public function index()
    {
        // Get all tiers
        $tiers = Tier::all()->sortBy('pledge');
        return View::make('backoffice.tiers.index')->with('tiers', $tiers);
    }

    /**
     * Create a new tier
     * @return mixed
     */
    public function create()
    {
        return View::make('backoffice.tiers.edit')
            ->with('data', [])
            ->with('new', true);
    }

    /**
     * Save a tier
     * @return mixed
     */
    public function store()
    {
        $success = true;
        $errors = [];

        // Validate
        $validator = Validator::make(
            Input::all(),
            [
                'tierValue' => 'required|numeric|unique:tier,pledge',
                'tierDescription' => 'required|min:4',
            ]
        );

        // Check if the validator fails
        if (!$validator->fails()) {
            // Save the tier
            Tier::create([
                'pledge' => Input::get('tierValue'),
                'description' => Input::get('tierDescription'),
            ]);
            Session::flash('info', trans('backoffice.flash.tier_create_success'));
        } else {
            // Validation has failed. Set success to false. Set validator messages
            $success = false;
            $errors = $validator->messages();
        }

        if ($success) {
            Donation::reassignAllTiers();
            return Redirect::route('admin::tiers');
        } else {
            return Redirect::back()->withErrors($errors)->withInput(Input::all());
        }
    }

    /**
     * Edit an existing tier
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $tier = Tier::find($id);
        return View::make('backoffice.tiers.edit')
            ->with('data', [
                "tierValue" => $tier->pledge,
                "tierDescription" => $tier->description,
            ])
            ->with('id', $id)
            ->with('new', false);
    }

    /**
     * Update an existing tier
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        $success = true;
        $errors = [];

        $tierValueValidation = 'required|numeric|unique:tier,pledge,' . $id;

        // Validate
        $validator = Validator::make(
            Input::all(),
            [
                'tierValue' => $tierValueValidation,
                'tierDescription' => 'required|min:4',
            ]
        );

        // Check if the validator fails
        if (!$validator->fails()) {
            // Save the tier
            Tier::find($id)->update([
                'pledge' => Input::get('tierValue'),
                'description' => Input::get('tierDescription'),
            ]);
            Session::flash('info', trans('backoffice.flash.tier_update_success'));
        } else {
            // Validation has failed. Set success to false. Set validator messages
            $success = false;
            $errors = $validator->messages();
        }

        if ($success) {
            Donation::reassignAllTiers();
            return Redirect::route('admin::tiers');
        } else {
            return Redirect::back()->withErrors($errors)->withInput(Input::all());
        }
    }

    /**
     * Delete an existing tier
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        Tier::find($id)->delete();
        Donation::reassignAllTiers();
        // TODO: Add flash message
        return Redirect::route('admin::tiers');
    }
}
