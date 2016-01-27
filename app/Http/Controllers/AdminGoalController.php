<?php

namespace W4P\Http\Controllers;

use Illuminate\Http\Request;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use W4P\Models\DonationType;
use W4P\Models\DonationKind; // fake model

use View;
use Validator;
use Session;
use Redirect;

class AdminGoalController extends Controller
{
    public function index(Request $request)
    {
        $donationTypes = DonationType::all()->groupBy('kind');
        $donationKinds = DonationKind::all();
        return View::make('backoffice.goals.index')
            ->with('donationTypes', $donationTypes)
            ->with('donationKinds', $donationKinds)
            ->with('currency', $request->project->currency);
    }

    public function kind($kind)
    {
        $donationTypes = DonationType::where('kind', $kind)->get();
        return View::make('backoffice.goals.kind')
            ->with('donationTypes', $donationTypes)
            ->with('kind', $kind);
    }


    public function createType($kind)
    {
        return View::make('backoffice.goals.type_edit')
            ->with('new', true)
            ->with('kind', $kind);
    }

    public function editType($kind, $id)
    {
        $donationType = DonationType::where('kind', $kind)->where('id', $id)->first();
        return View::make('backoffice.goals.type_edit')
            ->with('new', false)
            ->with('kind', $kind)
            ->with('id', $id)
            ->with('data', $donationType->toArray());
    }

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
            Session::flash('info', trans('backoffice.flash.goalTypeSaved'));
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
            Session::flash('info', trans('backoffice.flash.goalTypeUpdated'));
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

    public function deleteType($kind, $id)
    {
        DonationType::find($id)->delete();
        return Redirect::route('admin::goalsDetail', $kind);
    }

    public function currency(Request $request)
    {
        return View::make('backoffice.goals.currency')
            ->with('currency', $request->project->currency);
    }

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
            return Redirect::route('admin::goalsCurrency');
        } else {
            return Redirect::back()->withErrors($errors)->withInput(Input::all());
        }
    }
}
