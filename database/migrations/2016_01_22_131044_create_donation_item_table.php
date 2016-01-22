<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_item', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('donation_id');
            $table->unsignedInteger('donation_type_id');
            $table->datetime('confirmed_at')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('donation_item');
    }
}
