<?php

namespace W4P\Payment;

use Mollie_API_Client;

use W4P\Models\Donation;
use W4P\Models\Project;
use W4P\Models\Setting;
use Carbon\Carbon;
use URL;

class Mollie
{
    private $client;

    public function __construct()
    {
        $mollie_api_key = Setting::get('platform.mollie-key');
        if ($mollie_api_key != "" && $mollie_api_key != null) {
            $this->client = new Mollie_API_Client;
            $this->client->setApiKey($mollie_api_key);
        } else {
            abort(500, 'Payment cannot be started, no API key provided.');
        }
    }

    public function createPayment($donation_id)
    {
        // Get the donation
        $donation = Donation::find($donation_id);

        // Check if the donation wasn't paid
        if ($donation != null && $donation->confirmed == null && $donation->currency > 0) {
            try {

                // Create a new payment
                $payment = $this->client->payments->create([
                    "amount" => $donation->currency,
                    "description" => Project::first()->title . " | Donation #" . $donation_id,
                    "redirectUrl" => URL::to('donate::payment_status', ["donation_id" => $donation_id]),
                    "webhookUrl" => URL::to('payment_webhook', ["donation_id" => $donation_id]),
                    "metadata" => [
                        "donation_id" => $donation_id
                    ]
                ]);

                $donation->payment_id = $payment->id;
                $donation->save();

                // Redirect the user
                return Redirect::to($payment->getPaymentUrl());

            } catch (\Mollie_API_Exception $e) {
                echo "API call failed: " . htmlspecialchars($e->getMessage());
                echo " on field " . htmlspecialchars($e->getField());
            }
        } else {
            // Invalid payment
            echo "This donation is not eligible for payment via Mollie.";
        }
    }

    public function checkPayment($donation_id)
    {
        // Find the donation
        $donation = Donation::find($donation_id);
        // If donation does not exist, abort
        if ($donation == null) {
            App::abort(404, "This donation does not exist.");
        }
        // Get the payment
        $payment = $this->client->payments->get($donation->payment_id);

        // Check if payment is paid
        if ($payment->isPaid()) {
            // If the payment is paid, set paid_at
            $donation->confirmed = Carbon::now();
            // TODO: Send a confirmation email
        } elseif (! $payment->isOpen()) {
            // TODO: Mark payment as closed
        }
    }
}