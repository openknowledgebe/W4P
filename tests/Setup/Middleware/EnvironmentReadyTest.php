<?php

/**
 * @author Nico Verbruggen
 * @copyright 2015 Underlined bvba
 * @link https://underlined.be
 */

class EnvironmentReadyTest extends TestCase
{
    public function testRedirectsToSetupIfNotReady()
    {
        // Start a new session
        $this->startSession();
        // Environment is not ready, but request homepage
        $crawler = $this->call('GET', '/');
        // Assert we're being redirected
        // TODO: If all the setup steps are completed, this should redirect elsewhere (pwd is the only tested setting so far)
        $this->assertRedirectedToRoute('setup::step', 2);
        // Follow the redirects
        $this->followRedirects();
        // Assert that the response is OK
        $this->assertResponseOk();
    }
}
