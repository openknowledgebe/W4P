<?php

namespace W4P\Http\Controllers;

use Illuminate\Http\Request;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;

use W4P\Models\Post;

class PostController extends Controller
{
    /**
     * Get a list of all posts, sorted by created_at
     * @return mixed
     */
    public function index()
    {
        $posts = Post::all()->sortByDesc('created_at');
        return View::make('front.posts.index')->with('posts', $posts);
    }

    /**
     * Get a specific post
     * @param $id
     * @return mixed
     */
    public function detail($id)
    {
        $post = Post::find($id);
        return View::make('front.posts.detail')->with('post', $post);
    }
}
