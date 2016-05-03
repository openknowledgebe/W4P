<?php

namespace W4P\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;
use W4P\Models\Post;

use Session;
use Validator;
use Redirect;
use View;

class AdminPostController extends Controller
{
    /**
     * Get all posts
     * @return mixed
     */
    public function index()
    {
        // Get all tiers
        $posts = Post::all()->sortByDesc('created_at');
        return View::make('backoffice.posts.index')->with('posts', $posts);
    }

    /**
     * Create an new post
     * @return mixed
     */
    public function create()
    {
        return View::make('backoffice.posts.edit')
            ->with('data', [])
            ->with('new', true);
    }

    /**
     * Save a post
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
                'title' => 'required|min:4',
                'summary' => 'required|min:1|max:255',
                'content' => 'required|min:4',
            ]
        );

        // Check if the validator fails
        if (!$validator->fails()) {
            // Save the tier
            Post::create([
                'title' => Input::get('title'),
                'content' => Input::get('content'),
                "summary" => Input::get('summary'),
            ]);
            Session::flash('info', trans('backoffice.flash.post_create_success'));
        } else {
            // Validation has failed. Set success to false. Set validator messages
            $success = false;
            $errors = $validator->messages();
        }

        if ($success) {
            return Redirect::route('admin::posts');
        } else {
            return Redirect::back()->withErrors($errors)->withInput(Input::all());
        }
    }

    /**
     * Edit an existing post
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return View::make('backoffice.posts.edit')
            ->with('data', [
                "title" => $post->title,
                "content" => $post->content,
                "summary" => $post->summary,
            ])
            ->with('id', $id)
            ->with('new', false);
    }

    /**
     * Update an existing post
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        $success = true;
        $errors = [];

        // Validate
        $validator = Validator::make(
            Input::all(),
            [
                'title' => 'required|min:4',
                'summary' => 'required|min:1|max:255',
                'content' => 'required|min:4',
            ]
        );

        // Check if the validator fails
        if (!$validator->fails()) {
            // Save the tier
            Post::find($id)->update([
                "title" => Input::get('title'),
                "content" => Input::get('content'),
                "summary" => Input::get('summary')
            ]);
            Session::flash('info', trans('backoffice.flash.post_update_success'));
        } else {
            // Validation has failed. Set success to false. Set validator messages
            $success = false;
            $errors = $validator->messages();
        }

        if ($success) {
            return Redirect::route('admin::posts');
        } else {
            return Redirect::back()->withErrors($errors)->withInput(Input::all());
        }
    }

    /**
     * Delete an existing post
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        Post::find($id)->delete();
        // TODO: Add flash message
        return Redirect::route('admin::posts');
    }
}
