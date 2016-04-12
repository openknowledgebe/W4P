<?php

namespace W4P\Payment;

use Mollie_API_Client;
use W4P\Models\Donation;
use W4P\Models\Project;
use W4P\Models\Setting;
use Carbon\Carbon;
use Cache;
use URL;
use Log;

/**
 * Class Mollie for the Mollie facade
 * This is wrapper that makes the use of Mollie easier for W4P donations
 */
class Mollie
{
    /**
     * @var Mollie_API_Client
     * Client instance
     */
    private $client;
    private $error;

    /**
     * Mollie constructor
     * Creates and initializes the Mollie client from the Mollie PHP library
     */
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

    /**
     * Creates a new payment for a donation and returns a redirection link to the Mollie
     * payment page. If the process fails or the donation does not qualify for a payment
     * (for instance, it's a donation without money) an array is returned
     *
     * @param $donation_id: Unique ID of donation to create a new transaction for.
     * @return array|null|string: Returns an array of errors,
     * returns a redirection string _or_ null (if no redirection link is available)
     */
    public function createPayment($donation_id)
    {
        // Get the donation
        $donation = Donation::find($donation_id);

        // Check if the donation wasn't paid
        if ($donation != null && $donation->confirmed == null && $donation->currency > 0) {

            // The following process can go wrong, so catch exceptions
            try {
                // Set the redirection URL for when the payment is done so that Mollie can redirect back to us!
                $redirectUrl = URL::route('donate::payment_complete', ["donation_id" => $donation_id]);

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

                // Update the donation's payment ID & save it
                $donation->payment_id = $payment->id;
                $donation->save();

                // Return the payment URL
                return $payment->getPaymentUrl();

            } catch (\Mollie_API_Exception $e) {
                // If an exception occurs, fill the relevant information into the error message
                $this->error = [
                    "API call failed: " . htmlspecialchars($e->getMessage() . "."),
                    "Failed on field:" . htmlspecialchars($e->getField() . ".")
                ];
                // Also log this particular API exception
                Log::error(
                    "API call failed: " . $e->getMessage() . ".",
                    ["context" => "Failed on field:" . $e->getField() . "."]
                );
                // Return the error message
                return $this->error;
            }
        }

        // This donation is not eligible (was already confirmed, contains no currency or donation doesn't exist)
        $this->error = [
            "This donation is not eligible for payment via Mollie."
        ];
        return $this->error;
    }

    /**
     * Return the payment methods
     * @return \Mollie_API_Object_List|\Mollie_API_Object_Method[]
     */
    public function getPaymentMethods()
    {
        try {
            if (Cache::has('payment.methods')) {
                return json_decode(Cache::get('payment.methods'));
            } else {
                $methods = $this->client->methods->all();
                $expiresAt = Carbon::now()->addMinutes(60);
                Cache::put('payment.methods', json_encode($methods), $expiresAt);
                return $methods;
            }
        } catch (\Mollie_API_Exception $e) {
            // If an exception occurs, fill the relevant information into the error message
            $this->error = [
                "API call failed: " . htmlspecialchars($e->getMessage() . "."),
                "Failed on field:" . htmlspecialchars($e->getField() . ".")
            ];
            // Also log this particular API exception
            Log::error(
                "API call failed: " . $e->getMessage() . ".",
                ["context" => "Failed on field:" . $e->getField() . "."]
            );
            // Return the error message
            return [];
        }
    }

    /**
     * Checks the payment for a particular donation. Used for the Webhook
     * @param $donation_id: Unique ID of the donation that we want to check
     * @throws \Mollie_API_Exception
     */
    public function checkPayment($donation_id)
    {
        // Find the donation
        $donation = Donation::find($donation_id);

        // If donation does not exist, abort
        if ($donation == null) {
            App::abort(404, "This donation does not exist.");
        }

        try {
            // Get the payment
            $payment = $this->client->payments->get($donation->payment_id);

            // Check the flags, and assign the proper data to the donation object, and save
            if ($payment->isPaid()) {
                $donation->payment_status = "paid";
                $donation->confirmed = Carbon::now();
                $donation->save();
            }
            if ($payment->isPending()) {
                $donation->payment_status = "pending";
                $donation->save();
            }
            /* Failed payments, expired, refunded */
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

        } catch (\Mollie_API_Exception $e) {
            Log::error(
                "API call failed: " . $e->getMessage(),
                ["context" => "Failed on field:" . $e->getField() . "."]
            );
        }
    }
}
