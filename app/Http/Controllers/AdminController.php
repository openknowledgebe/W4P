<?php

namespace W4P\Http\Controllers;

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

class AdminController extends Controller
{
    public function dashboard()
    {
        return View::make('backoffice.dashboard');
    }

    public function project()
    {
        $data = [];
        $data['project'] = Project::get();
        return View::make('backoffice.project')
            ->with('data', $data);
    }

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
                'projectVideo' => 'mimes:mp4,qt,mov'
            ]
        );

        // Check if the validator fails
        if (!$validator->fails()) {

            $image = Input::file('projectLogo');
            if ($image != null && $image->isValid())
            {
                // Set the destination path for the platform logo
                $destinationPath = public_path() . '/project/logo.png';
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
            ]);

        } else {
            // Validation has failed. Set success to false. Set validator messages
            $success = false;
            $errors = $validator->messages();
        }

        if ($success) {
            return Redirect::back();
        } else {
            return Redirect::back()->withErrors($errors)->withInput(Input::all());
        }
    }

}
