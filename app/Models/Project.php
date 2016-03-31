<?php

namespace W4P\Models;

use Illuminate\Database\Eloquent\Model;
use W4P\Http\Traits\CanGetVideoInformation;

class Project extends Model
{
    use CanGetVideoInformation;

    protected $table = "project";
    public $timestamps = true;
    protected $fillable = ["title", "brief", "description", "video_url", "starts_at", "ends_at", "currency"];
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'starts_at', 'ends_at'];

    /**
     * Returns the project, if it exists. Returns null if it doesn't exist.
     *
     * @return mixed
     */
    public static function get()
    {
        return Project::all()->first();
    }

    /**
     * Checks if the project is valid. In order for the project to be valid,
     * it must have a title that is at least 1 character long, and a brief
     * description that is at least 1 character long.
     *
     * @param $project Project: The project that needs to be checked.
     * @return bool: Returns true if the project is valid.
     */
    public static function valid($project)
    {
        if ($project != null) {
            if (strlen($project->title) > 0 && strlen($project->brief) > 0) {
                return true;
            }
        }
        return false;
    }
}
