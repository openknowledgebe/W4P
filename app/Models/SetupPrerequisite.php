<?php

namespace W4P\Models;

class SetupPrerequisite
{
    public $title;
    public $description;
    public $fails;

    public static function create($title, $description, $failed)
    {
        $prerequisite = new SetupPrerequisite();
        $prerequisite->title = $title;
        $prerequisite->description = $description;
        $prerequisite->fails = $failed;
        return $prerequisite;
    }
}
