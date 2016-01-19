<?php

namespace W4P\Models;

use Illuminate\Database\Eloquent\Model;

class Tier extends Model
{
    protected $table = "tier";
    public $timestamps = true;

    protected $fillable = ['pledge', 'description'];
}
