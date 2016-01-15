<?php

use W4P\Models\Setting;

/**
 * @author Nico Verbruggen
 * @copyright 2015 Underlined bvba
 * @link https://underlined.be
 */

class SetupStepsAdministrationTest extends TestCase
{
    public function testIntroStep()
    {
        $this->visit('/setup')
            ->see('Welcome');
    }

    public function testAdministrationStep()
    {
        $this->visit('/setup/1')
            ->see('Password')
            ->see('Confirm password');

        // Check if the pwd setting exists
        $this->assertFalse(Setting::exists('pwd'));
    }

    public function testPasswordSubmitNotLongEnough() {
        $this->visit('/setup/1')
            ->see('Password')
            ->see('Confirm password');

        // Start a new session
        $this->startSession();

        // POST a new password (not long enough)
        $crawler = $this->call('POST', '/setup/1', [
            "password" => "root",
            "passwordConfirm" => "root"
        ]);

        // Check we are being redirected back
        $this->assertRedirectedToRoute('setup::step', 1);
        $this->followRedirects();
        $this->see('must be 6 characters or longer');

        // Check if the pwd setting exists
        $this->assertFalse(Setting::exists('pwd'));
    }

    public function testPasswordSubmit() {
        // POST a new password
        $crawler = $this->call('POST', '/setup/1', [
            "password" => "rootroot",
            "passwordConfirm" => "rootroot"
        ]);

        // Check if we are redirected to the next step
        $this->assertRedirectedToRoute('setup::step', 2);

        // Check if the pwd setting exists
        $this->assertTrue(Setting::exists('pwd'));
    }
}
