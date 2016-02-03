<?php

namespace W4P\Payment;

use Mollie_API_Client;

class Mollie
{
    private $client;

    public function __construct()
    {
        $this->client = new Mollie_API_Client;
    }

    public function createPayment()
    {
        // TODO
    }
}