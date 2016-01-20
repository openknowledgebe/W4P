<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchivedprojectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivedproject', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title'); // Title of the project
            $table->string('brief'); // Description in less than 255 characters
            $table->text('description')->nullable(); // Longer description, initially nullable
            $table->string('videoProvider'); // Longer description
            $table->string('videoUrl')->nullable(); // Video URL
            $table->dateTime('starts_at');
            $table->dateTime('ends_at');
            $table->boolean('success');
            $table->longText('backers'); // backers json
            $table->longText('goals'); // goals json
            $table->longText('meta'); // meta json
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
        Schema::drop('archivedproject');
    }
}
