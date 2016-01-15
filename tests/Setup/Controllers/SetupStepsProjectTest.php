<?php

use W4P\Models\Setting;

/**
 * @author Nico Verbruggen
 * @copyright 2015 Underlined bvba
 * @link https://underlined.be
 */

class SetupStepsProjectTest extends TestCase
{
    public function testPlatformSetupStep()
    {
        $this->visit('/setup/3')
            ->see('Project Setup');
        $this->assertFalse(Setting::exists('project.title'));
        $this->assertFalse(Setting::exists('project.brief'));
    }
}