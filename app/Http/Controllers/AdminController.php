<?php

namespace W4P\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;

use W4P\Models\Setting;
use W4P\Models\Project;

use View;
use Redirect;
use Validator;
use Request;
use Image;
use Mail;
use Session;

class AdminController extends Controller
{
    /**
     * Shows the dashboard admin page.
     * @return mixed
     */
    public function dashboard()
    {
        return View::make('backoffice.dashboard');
    }

    /**
     * Shows the project admin page.
     * @return mixed
     */
    public function project()
    {
        $data = [];
        $data['project'] = Project::get();
        return View::make('backoffice.project')
            ->with('data', $data);
    }

    /**
     * Updates the project details, redirects back to the project admin page.
     * @return mixed
     */
    public function updateProject()
    {
        $success = true;
        $errors = [];

        // Validate
        $validator = Validator::make(
            Input::all(),
            [
                'projectTitle' => 'required|min:4',
                'projectBrief' => 'required|min:4',
                'projectDescription' => 'min:4',
                'projectLogo' => 'image',
                'projectBanner' => 'image',
                'projectVideoProvider' => 'in:null,youtube,vimeo',
                'projectVideo' => 'min:4',
                'projectStartDate' => 'date',
                'projectEndDate' => 'date'
            ]
        );

        $validator->after(function($validator) {
            if (
                // Check if the end date is earlier than the start date
                date(Input::get('projectStartDate')) >
                date(Input::get('projectEndDate'))
            ) {
                $validator->errors()->add('projectEndDate', 'The end date is set before the start date. It must be set after the start date.');
            }
        });

        // Check if the validator fails
        if (!$validator->fails()) {

            $image = Input::file('projectLogo');
            if ($image != null && $image->isValid())
            {
                // Set the destination path for the platform logo
                $destinationPath = public_path() . '/project/logo.png';
                Image::make($image->getRealPath())->save($destinationPath);
            }

            $image = Input::file('projectBanner');
            if ($image != null && $image->isValid())
            {
                // Set the destination path for the platform logo
                $destinationPath = public_path() . '/project/banner.png';
                Image::make($image->getRealPath())->save($destinationPath);
            }

            $video = Input::file('projectVideo');
            if ($video != null && $video->isValid())
            {
                $destinationPath = public_path() . '/project/video.mp4';
                // Move the video
                $video->move($destinationPath);
            }

            // Save the project
            $project = Project::get();
            $project->update([
                'title' => Input::get('projectTitle'),
                'brief' => Input::get('projectTitle'),
                'description' => Input::get('projectDescription'),
                'videoProvider' => Input::get('projectVideoProvider'),
                'videoUrl' => Input::get('projectVideo'),
                'starts_at' => Carbon::createFromFormat('Y-m-d H:i', Input::get('projectStartDate')),
                'ends_at' => Carbon::createFromFormat('Y-m-d H:i', Input::get('projectEndDate')),
            ]);
            Session::flash('info', "Your project's details were updated successfully.");
        } else {
            // Validation has failed. Set success to false. Set validator messages
            $success = false;
            $errors = $validator->messages();
        }

        if ($success) {
            return Redirect::route('admin::project');
        } else {
            return Redirect::back()->withErrors($errors)->withInput(Input::all());
        }
    }

    /**
     * Shows the organisation admin page.
     * @return mixed
     */
    public function organisation()
    {
        $data = [
            "organisationName" => Setting::get('organisation.name'),
            "organisationDescription" => Setting::get('organisation.description'),
            "organisationLogo" => Setting::get('organisation.logo'),
            "organisationWebsite" => Setting::get('organisation.website')
        ];
        return View::make('backoffice.organisation')
            ->with('data', $data);
    }

    /**
     * Updates the organisation details, redirects back to the organisation admin page.
     * @return mixed
     */
    public function updateOrganisation()
    {
        $success = true;
        $errors = [];

        // Depending on whether a logo exists already, change the validation rule for the logo upload
        $logoValidationRule = 'required|image';
        if (file_exists(public_path() . "/organisation/logo.png")) {
            $logoValidationRule = 'image';
        }
        $validator = Validator::make(
            Input::all(),
            [
                'organisationName' => 'required|min:4',
                'organisationDescription' => 'required|min:4',
                'organisationWebsite' => 'required|min:4',
                'organisationLogo' => $logoValidationRule
            ]
        );
        // Check if the validator fails
        if (!$validator->fails()) {
            $image = Input::file('organisationLogo');
            if ($image != null && $image->isValid())
            {
                // Set the destination path for the platform logo
                $destinationPath = public_path() . '/organisation/logo.png';
                Image::make($image->getRealPath())->resize(400, 400)->save($destinationPath);
            }
            Setting::set('organisation.name', Input::get('organisationName'));
            Setting::set('organisation.description', Input::get('organisationDescription'));
            Setting::set('organisation.website', Input::get('organisationWebsite'));
            Setting::set('organisation.valid', 'true');
            Session::flash('info', "Your organisation's details were updated successfully.");
        } else {
            // Validation has failed. Set success to false. Set validator messages
            $success = false;
            $errors = $validator->messages();
        }

        if ($success) {
            return Redirect::route('admin::organisation');
        } else {
            return Redirect::back()->withErrors($errors)->withInput(Input::all());
        }
    }

    /**
     * Shows the platform admin page.
     * @return mixed
     */
    public function platform()
    {
        $data = [
            "platformOwnerName" => Setting::get('platform.name'),
            "analyticsId" => Setting::get('platform.analytics-id'),
            "mollieApiKey" => Setting::get('platform.mollie-key'),
        ];
        return View::make('backoffice.platform')
            ->with('data', $data);
    }

    /**
     * Updates the platform details, redirects back to the platform admin page.
     * @return mixed
     */
    public function updatePlatform()
    {
        $success = true;
        $errors = [];

        // Depending on whether a logo exists already, change the validation rule for the logo upload
        $logoValidationRule = 'required|image';
        if (file_exists(public_path() . "/platform/logo.png")) {
            $logoValidationRule = 'image';
        }
        $validator = Validator::make(
            Input::all(),
            [
                'platformOwnerName' => 'required|min:4',
                'platformOwnerLogo' => $logoValidationRule
            ]
        );
        // Check if the validator fails
        if (!$validator->fails()) {
            $image = Input::file('platformOwnerLogo');
            if ($image != null && $image->isValid())
            {
                // Set the destination path for the platform logo
                $destinationPath = public_path() . '/platform/logo.png';
                Image::make($image->getRealPath())->resize(400, 400)->save($destinationPath);
            }
            // Save the platform name
            Setting::set('platform.name', Input::get('platformOwnerName'));
            // Save the Google Analytics ID
            Setting::set('platform.analytics-id', Input::get('analyticsId'));
            // Save the Mollie API key
            Setting::set('platform.mollie-key', Input::get('mollieApiKey'));
            Session::flash('info', "Your platform's details were updated successfully.");
        } else {
            // Validation has failed. Set success to false. Set validator messages
            $success = false;
            $errors = $validator->messages();
        }

        if ($success) {
            return Redirect::route('admin::platform');
        } else {
            return Redirect::back()->withErrors($errors)->withInput(Input::all());
        }
    }

}
