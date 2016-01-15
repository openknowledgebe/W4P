<?php

use W4P\Models\Setting;

/**
 * @author Nico Verbruggen
 * @copyright 2015 Underlined bvba
 * @link https://underlined.be
 */

class SetupStepsPlatformTest extends TestCase
{
    public function testPlatformFieldsEmpty()
    {
        $this->visit('/setup/2')
            ->see('Platform Setup');
        $this->assertFalse(Setting::exists('platform.owner'));
        $this->assertFalse(Setting::exists('platform.analytics-id'));
        $this->assertFalse(Setting::exists('platform.mollie-key'));
    }

    // TODO: Unit test form submission
}