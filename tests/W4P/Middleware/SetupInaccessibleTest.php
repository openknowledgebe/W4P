<?php

/**
 * @author Nico Verbruggen
 * @copyright 2015 Underlined bvba
 * @link https://underlined.be
 */

class SetupInaccessibleTest extends TestCase
{
    public function testSetupIsInaccessibleAfterSetup()
    {
        // Start a new session
        $this->startSession();
        // Environment is not ready, but request homepage
        $crawler = $this->call('GET', '/setup');
        // Assert we're being redirected
        $this->assertRedirectedToRoute('home');
        // Follow the redirects
        $this->followRedirects();
        // Assert that the response is OK
        $this->assertResponseOk();
    }
}
