<?php

namespace W4P\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = "settings";
    public $timestamps = true;

    protected $fillable = ['key', 'value'];

    /**
     * Checks if a specific setting exists.
     * @param string $key The name of the key that needs to be checked.
     * @return bool
     */
    static function exists($key)
    {
        if (Setting::where('key', $key)->first() != null) {
            return true;
        }
        return false;
    }
}
