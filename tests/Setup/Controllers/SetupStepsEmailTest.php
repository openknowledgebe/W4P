<?php

use W4P\Models\Setting;

/**
 * @author Nico Verbruggen
 * @copyright 2015 Underlined bvba
 * @link https://underlined.be
 */

class SetupStepsEmailTest extends TestCase
{
    public function testEmailFieldsEmpty()
    {
        $this->visit('/setup/4')
            ->see('Email Setup');
        $this->assertFalse(Setting::exists('email.host'));
        $this->assertFalse(Setting::exists('email.port'));
        $this->assertFalse(Setting::exists('email.username'));
        $this->assertFalse(Setting::exists('email.password'));
        $this->assertFalse(Setting::exists('email.encryption'));
        $this->assertFalse(Setting::exists('email.from'));
        $this->assertFalse(Setting::exists('email.name'));
        $this->assertFalse(Setting::exists('email.valid'));
    }

    // TODO: Unit test form submission
}