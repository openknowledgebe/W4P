<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use W4P\Models\Setting;

class MigrateOrganisationFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $vat = Setting::where('key', 'organisation.vat')->first();
        if ($vat) {
            $vat->key = "platform.organisation.vat";
            $vat->save();
        }
        $address = Setting::where('key', 'organisation.address')->first();
        if ($address) {
            $address->key = "platform.organisation.address";
            $address->save();
        }
        $email = Setting::where('key', 'organisation.email')->first();
        if ($email) {
            $email->key = "platform.organisation.email";
            $email->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $vat = Setting::where('key', 'platform.organisation.vat')->first();
        if ($vat) {
            $vat->key = "organisation.vat";
            $vat->save();
        }
        $address = Setting::where('key', 'platform.organisation.address')->first();
        if ($address) {
            $address->key = "organisation.address";
            $address->save();
        }
        $email = Setting::where('key', 'platform.organisation.email')->first();
        if ($email) {
            $email->key = "organisation.email";
            $email->save();
        }
    }
}
