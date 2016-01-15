<?php

class TestCase  extends Illuminate\Foundation\Testing\TestCase
                implements PHPUnit_Framework_TestListener
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * All tests started
     * @param PHPUnit_Framework_TestSuite $suite
     */
    public function startTestSuite(PHPUnit_Framework_TestSuite $suite)
    {
        if ($suite->getName() === "setup") {
            printf("PHP version: " . phpversion() . "\n");
            printf("Initialising database...\n", $suite->getName());
            exec('rm database/testing.sqlite 2> /dev/null');
            exec('touch database/testing.sqlite');
            exec('php artisan migrate:reset --database=testing');
            exec('php artisan migrate --database=testing');
            printf("Initialised database. \n");
            printf("Started W4P Setup Test Suite: \n\n");
        }
        if ($suite->getName() === "application") {
            // Seeding test settings here
            exec('php artisan db:seed --database=testing --class=SettingsTestSeeder', $array);
            printf("Started W4P Application Test Suite: \n\n");
        }
    }

    /**
     * All tests completed
     */
    public function endTestSuite(PHPUnit_Framework_TestSuite $suite)
    {
        if ($suite->getName() === "setup") {
            printf("\n\n> Finished running setup test suite.");
            printf("\n\n");
        }
        if ($suite->getName() === "application") {
            printf("\n\n> Finished running application test suite.");
            printf("\n");
        }
    }

    public function addError(PHPUnit_Framework_Test $test, Exception $e, $time)
    {
    }

    public function addFailure(PHPUnit_Framework_Test $test, PHPUnit_Framework_AssertionFailedError $e, $time)
    {
    }

    public function addIncompleteTest(PHPUnit_Framework_Test $test, Exception $e, $time)
    {
    }

    public function addRiskyTest(PHPUnit_Framework_Test $test, Exception $e, $time)
    {
    }

    public function addSkippedTest(PHPUnit_Framework_Test $test, Exception $e, $time)
    {
    }

    public function startTest(PHPUnit_Framework_Test $test)
    {
    }

    public function endTest(PHPUnit_Framework_Test $test, $time)
    {
    }
}
