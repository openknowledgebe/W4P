<?php

namespace W4P\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = "settings";
    public $timestamps = true;

    protected $fillable = ['key', 'value'];
}
