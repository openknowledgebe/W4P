<?php

namespace W4P\Models;

use Illuminate\Database\Eloquent\Model;
use Markdown;

class Page extends Model
{
    protected $table = "pages";
    public $timestamps = true;

    protected $fillable = ['title', 'slug', 'content', 'default'];
}
