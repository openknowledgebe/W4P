<?php

namespace W4P\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;
use W4P\Models\SetupPrerequisite;
use W4P\Models\Setting;
use W4P\Models\Project;
use Carbon\Carbon;

use View;
use Redirect;
use Validator;
use Request;
use Image;
use Mail;
use DB;
use Config;
use EmailConfig;

class SetupController extends Controller
{
    /**
     * Shows the initial setup page when setting up the W4P environment.
     * @return string
     */
    public function index()
    {
        // Check prerequisites
        $prerequisites = [];

        // Laravel prerequisite
        $prerequisites[] = SetupPrerequisite::create(
            trans('setup.preq.titles.laravel_installation'),
            trans('setup.preq.checkmark'),
            false
        );

        // Check if node_modules folder exists
        if (file_exists(public_path() . "/../node_modules")) {
            $prerequisites[] = SetupPrerequisite::create(
                trans('setup.preq.titles.npm_modules'),
                trans('setup.preq.checkmark'),
                false
            );
        } else {
            $prerequisites[] = SetupPrerequisite::create(
                trans('setup.preq.titles.npm_modules'),
                trans('setup.preq.errors.npm_modules'),
                true
            );
        }

        // Check if the database connection is OK
        if (DB::connection()->getDatabaseName()) {
            $prerequisites[] = SetupPrerequisite::create(
                trans('setup.preq.titles.database_connection'),
                trans('setup.preq.checkmark'),
                false
            );
        } else {
            $prerequisites[] = SetupPrerequisite::create(
                trans('setup.preq.titles.database_connection'),
                trans('setup.preq.errors.database_connection'),
                true
            );
        }

        // Check if the correct folders are writable
        $writable = true;

        $folders = ["/images", "/organisation", "/project", "/platform", "/../database", "/../storage"];
        $not_writable = [];

        foreach ($folders as $folder) {
            $folder = public_path() . $folder;
            if (!is_writeable($folder)) {
                $writable = false;
                $not_writable[] = $folder;
            }
        }

        if ($writable) {
            $prerequisites[] = SetupPrerequisite::create(
                trans('setup.preq.titles.writable'),
                trans('setup.preq.checkmark'),
                false
            );
        } else {
            $notWritableString = "<ul>";
            foreach ($not_writable as $folder) {
                $notWritableString .= "<li>" . $folder . "</li>";
            }
            $notWritableString .= "</ul>";
            $prerequisites[] = SetupPrerequisite::create(
                trans('setup.preq.titles.writable'),
                "<p>" . trans('setup.preq.errors.writable') . "</p>" . $notWritableString,
                true
            );
        }

        // Based on count
        $failuresCount = 0;
        foreach ($prerequisites as $preq) {
            if ($preq->fails) {
                $failuresCount++;
            }
        }

        // Loop through all prerequisite checks
        if ($failuresCount == 0) {
            return View::make('setup.welcome');
        } else {
            return View::make('setup.prerequisite_failures')
                ->with('preqs', $prerequisites);
        }

    }

    /**
     * Shows a specific page
     * @param int $number The step we want to see in the wizard.
     * @return mixed
     */
    public function showStep($number)
    {
        $data = [];
        switch ($number) {
            case 1:
                break;
            case 2:
                $data = [
                    "platformOwnerName" => Setting::get('platform.name'),
                    "analyticsId" => Setting::get('platform.analytics-id'),
                    "mollieApiKey" => Setting::get('platform.mollie-key'),
                    "platformOrganisationName" => Setting::get('platform.organisation.name'),
                    "platformOrganisationAddress" => Setting::get('platform.organisation.address'),
                    "platformOrganisationVAT" => Setting::get('platform.organisation.vat'),
                    "platformOrganisationEmail" => Setting::get('platform.organisation.email')
                ];
                break;
            case 3:
                $data = [
                    "organisationName" => Setting::get('organisation.name'),
                    "organisationDescription" => Setting::get('organisation.description'),
                    "organisationLogo" => Setting::get('organisation.logo'),
                    "organisationWebsite" => Setting::get('organisation.website'),
                ];
                break;
            case 4:
                $project = Project::all()->first();
                if (!$project) {
                    $data = [
                        "projectTitle" => null,
                        "projectBrief" => null,
                    ];
                } else {
                    $data = [
                        "projectTitle" => $project->title,
                        "projectBrief" => $project->brief,
                    ];
                }

                break;
            case 5:
                $data = [
                    "emailHost" => Setting::get('email.host'),
                    "emailPort" => Setting::get('email.port'),
                    "emailUsername" => Setting::get('email.username'),
                    "emailPassword" => Setting::get('email.password'),
                    "emailEncryption" => Setting::get('email.encryption'),
                    "emailFrom" => Setting::get('email.from'),
                    "emailName" => Setting::get('email.name'),
                ];
                break;
            default:
                $data = [];
                break;
        }
        return View::make('setup.step' . $number)
            ->with('step', $number)
            ->with('data', $data);
    }

    // Errors for the current POST request
    private $errors;
    // Was the POST request successful?
    private $success;
    // Is the wizard done?
    private $done;

    /**
     * Handle the form input that was sent from a specific step.
     * Sets $this->success & $this->errors depending on input
     *
     * @param int $number Step of the submitted data
     * @return Redirect
     */
    public function handleStep($number)
    {
        // Assume the request is successful (each failed check resets this to false)
        $this->success = true;
        // Assume no errors (empty); each failed check adds a new error to this array
        $this->errors = [];
        $this->done = false;

        switch ($number) {
            case 1:
                $this->handleMasterPasswordValidation();
                break;
            case 2:
                $this->handleOrganisationValidation();
                break;
            case 3:
                $this->handleOrganisationStep2Validation();
                break;
            case 4:
                $this->handleProjectValidation();
                break;
            case 5:
                $this->handleEmailConfigValidation();
                break;
            case 6:
                $this->finalizeSetupProcess();
                break;
            default:
                break;
        }
        if ($this->done) {
            return Redirect::route('home');
        }
        if ($this->success) {
            return Redirect::route("setup::step", ($number + 1));
        } else {
            return Redirect::back()->withErrors($this->errors)->withInput(Input::all());
        }
    }

    /**
     * Handle master password validation
     */
    private function handleMasterPasswordValidation()
    {
        // If the password already exists, allow inputs to be empty
        if (Setting::exists('pwd') && strlen(Input::get('password')) == 0) {
            // Proceed to the next step, don't do anything else
        } else {
            // Check if the passwords match
            if (Input::get('password') != Input::get('passwordConfirm')) {
                array_push($this->errors, trans('setup.detail.admin.validation.nomatch'));
                $this->success = false;
            }
            // Check if the password is 6 characters or longer
            if (strlen(Input::get('password')) <= 5) {
                array_push($this->errors, trans('setup.detail.admin.validation.length'));
                $this->success = false;
            }
            if ($this->success) {
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
        }
    }

    /**
     * Handle organisation validation
     */
    private function handleOrganisationValidation()
    {
        // Depending on whether a logo exists already, change the validation rule for the logo upload
        $logoValidationRule = 'required|image';
        if (file_exists(public_path() . "/platform/logo.png")) {
            $logoValidationRule = 'image';
        }

        $defaultRules = [
            'platformOwnerName' => 'required|min:4',
            'platformOwnerLogo' => $logoValidationRule
        ];

        // Validation rules if organisation address, vat, email are not required
        // (mollie has not been setup!)
        $notRequired = [
            "platformOrganisationAddress" => 'min:5',
            "platformOrganisationVAT" => 'min:5',
            "platformOrganisationEmail" => 'email',
            "platformOrganisationName" => 'min:2',
        ];

        // Validation rules if organisation address, vat and email ARE required
        $required = [
            "platformOrganisationAddress" => 'required|min:5',
            "platformOrganisationVAT" => 'required|min:5',
            "platformOrganisationEmail" => 'required|email',
            "platformOrganisationName" => 'required|min:2'
        ];

        Setting::set('platform.organisation.valid', 'true');

        $mollie = Input::get('mollieApiKey');
        if ($mollie != "" && $mollie != null) {
            $validation = array_merge($defaultRules, $required);
        } else {
            $validation = array_merge($defaultRules, $notRequired);
        }

        $validator = Validator::make(
            Input::all(),
            $validation
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
            Setting::set('platform.name', Input::get('platformOwnerName'));
            // Save the Google Analytics ID
            Setting::set('platform.analytics-id', Input::get('analyticsId'));
            // Save the Mollie API key
            Setting::set('platform.mollie-key', Input::get('mollieApiKey'));
            // Save org details
            Setting::set('platform.organisation.address', Input::get('platformOrganisationAddress'));
            Setting::set('platform.organisation.email', Input::get('platformOrganisationEmail'));
            Setting::set('platform.organisation.name', Input::get('platformOrganisationName'));
            Setting::set('platform.organisation.vat', Input::get('platformOrganisationVAT'));
        } else {
            // Validation has failed. Set success to false. Set validator messages
            $this->success = false;
            $this->errors = $validator->messages();
        }
    }

    /**
     * Validate organisation fields
     */
    private function handleOrganisationStep2Validation()
    {
        // Depending on whether a logo exists already, change the validation rule for the logo upload
        $logoValidationRule = 'required|image';
        if (file_exists(public_path() . "/organisation/logo.png")) {
            $logoValidationRule = 'image';
        }

        // Default validation rules
        $defaultRules = [
            'organisationName' => 'required|min:4',
            'organisationDescription' => 'required|min:4',
            'organisationWebsite' => 'required|min:4',
            'organisationLogo' => $logoValidationRule
        ];

        $validator = Validator::make(
            Input::all(),
            $defaultRules
        );
        // Check if the validator fails
        if (!$validator->fails()) {
            $image = Input::file('organisationLogo');
            if ($image != null && $image->isValid()) {
                // Set the destination path for the organisation logo
                $destinationPath = public_path() . '/organisation/logo.png';
                Image::make($image->getRealPath())->resize(400, 400)->save($destinationPath);
            }
            Setting::set('organisation.name', Input::get('organisationName'));
            Setting::set('organisation.description', Input::get('organisationDescription'));
            Setting::set('organisation.website', Input::get('organisationWebsite'));
            Setting::set('organisation.vat', Input::get('organisationVAT'));
        } else {
            // Validation has failed. Set success to false. Set validator messages
            $this->success = false;
            $this->errors = $validator->messages();
        }
    }

    /**
     * Validate project fields
     */
    private function handleProjectValidation()
    {
        $validator = Validator::make(
            Input::all(),
            [
                'projectTitle' => 'required|min:4',
                'projectBrief' => 'required|min:4'
            ]
        );
        // Check if the validator fails
        if (!$validator->fails()) {
            // Get the first record
            $project = Project::all()->first();
            $data = [
                "title" => Input::get('projectTitle'),
                "brief" => Input::get('projectBrief'),
                "starts_at" => Carbon::now(),
                "ends_at" => Carbon::now()->addMonth(),
                "videoProvider" => "null",
            ];
            if ($project == null) {
                Project::create($data);
            } else {
                $project->update($data);
            }
        } else {
            // Validation has failed. Set success to false. Set validator messages
            $this->success = false;
            $this->errors = $validator->messages();
        }
    }

    /**
     * Validate email fields
     */
    private function handleEmailConfigValidation()
    {
        $validator = Validator::make(
            Input::all(),
            [
                'emailHost' => 'required|min:3',
                'emailPort' => 'required|min:1',
                'emailFrom' => 'required|email|min:3',
                'emailName' => 'required|min:3',
                'emailEncryption' => 'required|in:tls,ssl,null',
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

            // Override the email config with the one from the DB
            EmailConfig::loadFromDb();

            // Test new configuration
            try {
                Mail::queue('mails.test', [], function ($message) {
                    $message->to(Input::get('emailFrom'), Input::get('emailName'))
                        ->subject(trans('setup.generic.mailSuccess'));
                });
                Setting::set('email.valid', 'true');
            } catch (\Exception $ex) {
                $this->success = false;
                $this->errors = [
                    trans('setup.generic.mailFail') . " Exception message: " . $ex->getMessage(),
                ];
            }

        } else {
            // Validation has failed. Set success to false. Set validator messages
            $this->success = false;
            $this->errors = $validator->messages();
        }
    }

    /**
     * Finalize the setup process by setting setup.complete
     */
    private function finalizeSetupProcess()
    {
        Setting::set('setup.complete', 'done');
        $this->done = true;
    }
}
