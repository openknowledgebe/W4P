<?php

namespace W4P\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;

use W4P\Models\Page;
use View;
use Redirect;
use Validator;
use Request;
use Image;
use Mail;
use Session;

class AdminPageController extends Controller
{
    /**
     * Edit an existing page
     * @param $slug
     * @return mixed
     */
    public function edit($slug)
    {
        $page = Page::where('slug', $slug)->first();
        return View::make('backoffice.pages.edit')
            ->with('page', $page);
    }

    /**
     * Update an existing page
     * @param $slug
     * @return mixed
     */
    public function update($slug)
    {
        $success = true;
        $errors = [];

        // Validate
        $validator = Validator::make(
            Input::all(),
            [
                'content' => 'required|min:4',
            ]
        );

        // Check if the validator fails
        if (!$validator->fails()) {
            // Save the tier
            Page::where('slug', $slug)->first()->update([
                "content" => Input::get('content')
            ]);
            Session::flash('info', trans('backoffice.flash.page_update_success'));
        } else {
            // Validation has failed. Set success to false. Set validator messages
            $success = false;
            $errors = $validator->messages();
        }

        if ($success) {
            return Redirect::route('admin::editPage', $slug);
        } else {
            return Redirect::back()->withErrors($errors)->withInput(Input::all());
        }
    }
}
