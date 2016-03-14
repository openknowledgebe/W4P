<?php

namespace W4P\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;

use W4P\Models\Setting;
use W4P\Models\Project;
use W4P\Models\Donation;
use W4P\Models\DonationKind;
use W4P\Models\DonationType;

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
        // Get the project
        $project = Project::first();

        // Get all donation types & kinds
        $donationTypes = DonationType::all()->groupBy('kind');
        $donationKinds = DonationKind::all();

        // Get when the project runs out
        $ends_at = new Carbon($project->ends_at);
        $now = Carbon::now();
        $leftDays = $now->diffInDays($ends_at);
        $leftHours = $now->diffInHours($ends_at);

        // Get how many contributors there are
        $donorQuery = Donation::whereNotNull('confirmed')->get();
        $donorCount = $donorQuery->groupBy('email')->count();
        $contributed = $donorQuery->sum('currency');

        // Calculate the contributed percentage of the total amount of money
        $contributedPercentage = 0;
        if ($project->currency > 0) {
            $contributedPercentage = round(($contributed / $project->currency) * 100, 1);
        }

        // Get percentages from donations (for 4 kinds -> manpower, coaching, etc.)
        $percentages = DonationKind::getAllPercentages($donorQuery);

        // Get latest donations
        $donations = Donation::limit(5)->orderBy('id', 'DESC')->get();

        return View::make('backoffice.dashboard')
            ->with("project", $project)
            ->with("hoursleft", $leftHours)
            ->with("daysleft", $leftDays)
            ->with('donationTypes', $donationTypes)
            ->with('donationKinds', $donationKinds)
            ->with('donorCount', $donorCount)
            ->with('contributed', $contributed)
            ->with('contributedPercentage', $contributedPercentage)
            ->with('percentages', $percentages)
            ->with('donations', $donations);
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

        $validator->after(function ($validator) {
            // Check if the end date is earlier than the start date
            if (date(Input::get('projectStartDate')) > date(Input::get('projectEndDate'))) {
                $validator->errors()->add(
                    'projectEndDate',
                    'The end date is set before the start date.' .
                    'It must be set after the start date.'
                );
            }
        });

        // Check if the validator fails
        if (!$validator->fails()) {

            $image = Input::file('projectLogo');
            if ($image != null && $image->isValid()) {
                // Set the destination path for the platform logo
                $destinationPath = public_path() . '/project/logo.png';
                Image::make($image->getRealPath())->save($destinationPath);
            }

            $image = Input::file('projectBanner');
            if ($image != null && $image->isValid()) {
                // Set the destination path for the platform logo
                $destinationPath = public_path() . '/project/banner.png';
                Image::make($image->getRealPath())->save($destinationPath);
            }

            $video = Input::file('projectVideo');
            if ($video != null && $video->isValid()) {
                $destinationPath = public_path() . '/project/video.mp4';
                // Move the video
                $video->move($destinationPath);
            }

            // Save the project
            $project = Project::get();
            $project->update([
                'title' => Input::get('projectTitle'),
                'brief' => Input::get('projectBrief'),
                'description' => Input::get('projectDescription'),
                'video_url' => Input::get('projectVideo'),
                'starts_at' => Carbon::createFromFormat('Y-m-d H:i', Input::get('projectStartDate')),
                'ends_at' => Carbon::createFromFormat('Y-m-d H:i', Input::get('projectEndDate')),
            ]);
            Session::flash('info', trans('backoffice.flash.project_update_success'));
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
            if ($image != null && $image->isValid()) {
                // Set the destination path for the platform logo
                $destinationPath = public_path() . '/organisation/logo.png';
                Image::make($image->getRealPath())->resize(400, 400)->save($destinationPath);
            }
            Setting::set('organisation.name', Input::get('organisationName'));
            Setting::set('organisation.description', Input::get('organisationDescription'));
            Setting::set('organisation.website', Input::get('organisationWebsite'));
            Setting::set('organisation.valid', 'true');
            Session::flash('info', trans('backoffice.flash.org_update_success'));
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
            "platformCopyright" => Setting::get('platform.copyright'),
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
            if ($image != null && $image->isValid()) {
                // Set the destination path for the platform logo
                $destinationPath = public_path() . '/platform/logo.png';
                Image::make($image->getRealPath())->resize(400, 400)->save($destinationPath);
            }
            // Save the platform name
            Setting::set('platform.copyright', Input::get('platformCopyright'));
            Setting::set('platform.name', Input::get('platformOwnerName'));
            // Save the Google Analytics ID
            Setting::set('platform.analytics-id', Input::get('analyticsId'));
            // Save the Mollie API key
            Setting::set('platform.mollie-key', Input::get('mollieApiKey'));
            Session::flash('info', trans('backoffice.flash.platform_update_success'));
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

    /**
     * Get email settings form
     * @return mixed
     */
    public function email()
    {
        $data = [
            "emailHost" => Setting::get('email.host'),
            "emailPort" => Setting::get('email.port'),
            "emailUsername" => Setting::get('email.username'),
            "emailPassword" => Setting::get('email.password'),
            "emailEncryption" => Setting::get('email.encryption'),
            "emailFrom" => Setting::get('email.from'),
            "emailName" => Setting::get('email.name'),
        ];
        return View::make('backoffice.email')
            ->with('data', $data);
    }

    /**
     * Update existing email settings
     * @return mixed
     */
    public function updateEmail()
    {
        $success = true;
        $errors = [];

        $validator = Validator::make(
            Input::all(),
            [
                'emailHost' => 'required|min:3',
                'emailPort' => 'required|min:1',
                'emailFrom' => 'required|email|min:3',
                'emailName' => 'required|min:3',
                'emailEncryption' => 'required|in:tls,null',
            ]
        );
        // Check if the validator fails
        if (!$validator->fails()) {
            Setting::set('email.host', Input::get('emailHost'));
            Setting::set('email.port', Input::get('emailPort'));
            Setting::set('email.username', Input::get('emailUsername'));
            Setting::set('email.password', Input::get('emailPassword'));
            $encryption = Input::get('emailEncryption');
            if ($encryption == "null") {
                $encryption = "";
            }
            Setting::set('email.encryption', $encryption);
            Setting::set('email.from', Input::get('emailFrom'));
            Setting::set('email.name', Input::get('emailName'));
            // Test configuration
            try {
                Mail::queue('mails.test', [], function ($message) {
                    $message->to(Input::get('emailFrom'), Input::get('emailName'))
                        ->subject(trans('setup.generic.mailSuccess'));
                });
                Session::flash('info', trans('backoffice.flash.mail_validation_success'));
            } catch (\Exception $ex) {
                $success = false;
                $errors = [
                    trans('backoffice.flash.mail_validation_failed')
                ];
            }

        } else {
            // Validation has failed. Set success to false. Set validator messages
            $success = false;
            $errors = $validator->messages();
        }

        if ($success) {
            return Redirect::route('admin::email');
        } else {
            return Redirect::back()->withErrors($errors)->withInput(Input::all());
        }
    }

    /**
     * Show password reset form
     */
    public function password()
    {
        return View::make('backoffice.pw_reset');
    }

    /**
     * Actually reset the password
     */
    public function updatePassword()
    {
        $success = true;
        $errors = [];

        // Check if the old password matches
        if (!Hash::check(Input::get('passwordOld'), Setting::get('pwd'))) {
            array_push($errors, trans('setup.detail.admin.validation.old_pw_incorrect'));
            $success = false;
        }

        // Check if the passwords match
        if (Input::get('password') != Input::get('passwordConfirm')) {
            array_push($errors, trans('setup.detail.admin.validation.nomatch'));
            $success = false;
        }
        // Check if the password is 6 characters or longer
        if (strlen(Input::get('password')) <= 5) {
            array_push($this->errors, trans('setup.detail.admin.validation.length'));
            $success = false;
        }
        if ($success) {
            // Hash the password
            $hashedPassword = Hash::make(Input::get('password'));
            // Depending on whether the password exists, update or create a new setting
            if (Setting::exists('pwd')) {
                $this->success = Setting::updateKeyValuePair('pwd', $hashedPassword);
            } else {
                $this->success = Setting::createKeyValuePair('pwd', $hashedPassword);
            }
            if (!$this->success) {
                array_push($errors, trans('setup.detail.admin.validation.generic'));
            }
        }

        // Check if new passwords match
        if ($success) {
            Session::flash('info', trans('backoffice.flash.password_change_success'));
            return Redirect::back();
        } else {
            return Redirect::back()->withErrors($errors)->withInput(Input::all());
        }
    }

    /**
     * Get all assets from the /images folder (uploads) and return the view that displays them.
     * @return mixed: Shows the assets page
     */
    public function assets()
    {
        $images = array_slice(scandir(public_path() . "/images"), 2);
        return View::make('backoffice.assets')
            ->with('images', $images);
    }

    /**
     * Delete an asset with a particular filename.
     * @param $filename: Filename of the file you want to delete.
     * @return mixed: Redirects back to the assets page
     */
    public function deleteAsset($filename)
    {
        unlink(public_path() . "/images/" . $filename);
        return Redirect::route('admin::assets');
    }

    /**
     * Get all donations ordered by ID
     * @return mixed
     */
    public function donations()
    {
        $donations = Donation::orderBy('id', 'DESC')->get();
        return View::make('backoffice.donations')->with('donations', $donations);
    }

    /**
     * Export all users to UTF-8 encoded csv
     * Opens a stream and closes it (first_name, last_name)
     */
    public function exportUsers()
    {
        // Set headers
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=donors.csv');

        // Get all users (unique)
        $users = Donation::whereNotNull('confirmed')->get()->groupBy('email');
        $output = fopen('php://output', 'w');
        fputcsv($output, array('name', 'email'));
        foreach ($users as $key => $user) {
            fputcsv($output, [
                $user[0]->first_name . " " . $user[0]->last_name,
                $key
            ]);
        }

        // Exit file stream
        exit();
    }
}
