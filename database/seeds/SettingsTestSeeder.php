<?php

use Illuminate\Database\Seeder;
use W4P\Models\Setting;

use Illuminate\Support\Facades\Hash;

class SettingsTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::set('pwd', Hash::make('testtest'));
        Setting::set('platform.name', 'Open Knowledge');
        Setting::set('platform.analytics-id', '');
        Setting::set('platform.mollie-key', '');
        Setting::set('project.title', 'Test project');
        Setting::set('project.brief', 'Test project description');
        Setting::set('email.host', '127.0.0.1');
        Setting::set('email.port', '1025');
        Setting::set('email.username', '');
        Setting::set('email.password', '');
        Setting::set('email.encryption', '');
        Setting::set('email.from', 'test@mail.okfnbe');
        Setting::set('email.name', 'Test mail');
        Setting::set('email.valid', 'true');
    }
}
