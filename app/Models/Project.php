<?php

namespace W4P\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = "project";
    public $timestamps = true;
    protected $fillable = ["title", "brief", "description", "videoProvider", "videoUrl", "starts_at", "ends_at"];
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'starts_at', 'ends_at'];

    /**
     * Returns the project, if it exists. Returns null if it doesn't exist.
     * @return mixed
     */
    public static function get() {
       return Project::all()->first();
    }

    /**
     * Checks if the project is valid. In order for the project to be valid,
     * it must have a title that is at least 1 character long, and a brief
     * description that is at least 1 character long.
     * @return bool
     */
    public static function valid() {
        $project = Project::all()->first();
        if ($project) {
            if (strlen($project->title) > 0 && strlen($project->brief) > 0) {
                return true;
            }
        }
        return false;
    }
}
