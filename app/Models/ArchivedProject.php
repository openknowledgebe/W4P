<?php

namespace W4P\Models;

use Illuminate\Database\Eloquent\Model;
use W4P\Http\Traits\CanGetVideoInformation;

class ArchivedProject extends Model
{
    use CanGetVideoInformation;

    protected $table = "archivedproject";
    public $timestamps = true;
    protected $fillable = ["title", "brief", "description", "meta", "starts_at", "ends_at", "success", "video_url"];
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'starts_at', 'ends_at'];
}
