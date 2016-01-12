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

    /**
     * Creates a key value pair that is stored in the database.
     * Returns true if the KVP was created.
     * @param $key
     * @param $value
     * @returns boolean
     */
    public static function createKeyValuePair($key, $value)
    {
        if (!Setting::exists($key)) {
            Setting::create([
                "key" => $key,
                "value" => $value
            ]);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Creates a key value pair that is stored in the database.
     * Returns true if the KVP was saved.
     * @param $key
     * @param $value
     * @returns boolean
     */
    public static function updateKeyValuePair($key, $value)
    {
        $kvp = Setting::where('key', $key)->first();
        if ($kvp == null) {
            return false;
        } else {
            $kvp->value = $value;
            $kvp->save();
            return true;
        }
    }
}
