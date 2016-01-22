<?php

namespace W4P\Http\Controllers;

use Illuminate\Http\Request;

use W4P\Http\Requests;
use W4P\Http\Controllers\Controller;

use W4P\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all()->sortByDesc('created_at');
        return View::make('project.posts.index')->with('posts', $posts);
    }

    public function detail($id)
    {
        $post = Post::find($id);
        return View::make('project.posts.detail')->with('post', $post);
    }
}
