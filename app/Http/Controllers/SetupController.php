<?php

namespace W4P\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;
use W4P\Models\Setting;

use View;
use Redirect;

class SetupController extends Controller
{
    /**
     * Shows the initial setup page when setting up the W4P environment.
     * @return string
     */
    public function index()
    {
        return View::make('setup.welcome');
    }

    /**
     * Shows a specific page
     * @param int $number The step we want to see in the wizard.
     * @return mixed
     */
    public function showStep($number)
    {
        return View::make('setup.step' . $number)
            ->with('step', $number);
    }

    // Errors for the current POST request
    private $errors;
    // Was the POST request successful?
    private $success;

    /**
     * Handle the form input that was sent from a specific step.
     * @param int $number Step of the submitted data
     * @return Redirect
     */
    public function handleStep($number)
    {
        // Assume the request is successful (each failed check resets this to false)
        $this->success = true;
        // Assume no errors (empty); each failed check adds a new error to this array
        $this->errors = [];

        switch ($number) {
            case 1:
                $this->handleMasterPasswordValidation();
                break;
            case 2:
                // $this->handleOrganisationValidation();
                break;
            case 3:
                break;
            default:
                break;
        }
        if ($this->success) {
            return Redirect::to('/setup/' . ($number + 1));
        } else {
            return Redirect::back()->withErrors($this->errors)->withInput();
        }

    }

    /**
     * Handle master password validation
     * Sets $this->success & $this->errors depending on input.
     */
    private function handleMasterPasswordValidation()
    {
        // Check if the passwords match
        if (Input::get('password') != Input::get('passwordConfirm')) {
            array_push($this->errors, "The passwords do not match.");
            $this->success = false;
        }
        // Check if the password is 6 characters or longer
        if (strlen(Input::get('password')) <= 5) {
            array_push($this->errors, "Your password must be 6 characters or longer.");
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
                array_push($errors, "Something went wrong saving the password in the database.");
            }
        }
    }
}
