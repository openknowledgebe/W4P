<?php

use Illuminate\Database\Seeder;
use W4P\Models\Setting;

class SettingsDevTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Setting::where('key', 'app-key')->first() != null) {
            echo "The key-value pair 'app-key' already exists.";
        } else {
            Setting::create([
                'key' => 'app-key',
                'value' => "ABC"
            ]);
        }
    }
}
