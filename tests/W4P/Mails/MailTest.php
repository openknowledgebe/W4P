<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MailTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testSendMailcatcherMail()
    {
        exec("pgrep mailcatcher", $pids);
        if(empty($pids)) {
            $this->markTestSkipped("MailCatcher is not running. Test skipped.");
        } else {
            Mail::queue('mails.test', [], function($message) {
                $message->to("test@dev.test", "test")
                    ->subject('Test message');
            });
        }
    }
}
