<?php

namespace W4P\Models;

use Illuminate\Database\Eloquent\Model;

class ArchivedProject extends Model
{
    protected $table = "archivedproject";
    public $timestamps = true;
    protected $fillable = ["title", "brief", "description", "meta", "starts_at", "ends_at", "success"];
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'starts_at', 'ends_at'];
}
