<?php

namespace W4P\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = "settings";
    public $timestamps = true;

    protected $fillable = ['key', 'value'];

    /**
     * Gets value for a specific setting; if setting does not exist (or is empty), return null
     * @param string $key
     * @return string | null
     */
    public static function get($key) {
        $setting = Setting::where('key', $key)->first();
        if ($setting != null) {
            return $setting->value;
        } else {
            return null;
        }
    }

    /**
     * Set a specific key.
     * @param string $key Key to set
     * @param string $value Value to save
     * @return boolean
     */
    public static function set($key, $value)
    {
        if (Setting::exists($key)) {
            return Setting::updateKeyValuePair($key, $value);
        } else {
            return Setting::createKeyValuePair($key, $value);
        }
    }

    /**
     * Checks if a specific setting exists.
     * @param string $key The name of the key that needs to be checked.
     * @return bool
     */
    public static function exists($key)
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

    /**
     * Get all settings that begin with a specific word
     * @param $string
     * @return array
     */
    public static function getBeginsWith($string)
    {
        $values = Setting::where('key', 'LIKE', "%$string%")->get()->toArray();
        $settings = [];
        foreach ($values as $kvp) {
            $settings[$kvp['key']] = $kvp['value'];
        }
        return $settings;
    }
}
