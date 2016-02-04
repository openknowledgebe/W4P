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
                $redirectUrl = URL::route('donate::payment_complete', ["donation_id" => $donation_id]);
                dd($redirectUrl);
                // Create a new payment
                $payment = $this->client->payments->create([
                    "amount" => $donation->currency,
                    "description" => trans('donation.donation_for') . " " . Project::first()->title,
                    "redirectUrl" => $redirectUrl,
                    "webhookUrl" => URL::route('payment_webhook', ["donation_id" => $donation_id]),
                    "metadata" => [
                        "donation_id" => $donation_id
                    ]
                ]);

                $donation->payment_id = $payment->id;
                $donation->save();

                return $payment->getPaymentUrl();

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

        /** Pending or paid */
        if ($payment->isPaid()) {
            // If the payment is paid, set payment_status
            $donation->payment_status = "paid";
            $donation->confirmed = Carbon::now();
            $donation->save();
        }
        if ($payment->isPending()) {
            $donation->payment_status = "pending";
            $donation->save();
        }
        /** Failed payments, expired, refunded */
        if ($payment->isRefunded()) {
            $donation->payment_status = "refunded";
            $donation->confirmed = null;
            $donation->save();
        }
        if ($payment->isChargedBack()) {
            $donation->payment_status = "chargedback";
            $donation->confirmed = null;
            $donation->save();
        }
        if ($payment->isCancelled()) {
            $donation->payment_status = "cancelled";
            $donation->save();
        }
        if ($payment->isExpired()) {
            $donation->payment_status = "expired";
            $donation->save();
        }

    }
}