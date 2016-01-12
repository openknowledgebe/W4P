<?php

namespace W4P\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "post";
    public $timestamps = true;

    protected $fillable = ['title', 'content'];
}
