<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->decimal('currency');
            $table->string('payment_id')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('secret_url')->unique();
            $table->string('confirm_url')->unique();
            $table->datetime('confirmed')->nullable();
            $table->unsignedInteger('tier_id')->nullable();
            $table->text('message')->nullable();
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
        Schema::drop('donation');
    }
}
