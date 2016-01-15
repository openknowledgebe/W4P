<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'project',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('title'); // Title of the project
                $table->string('brief'); // Description in less than 255 characters
                $table->text('description'); // Longer description
                $table->string('videoProvider'); // Longer description
                $table->string('videoUrl')->nullable(); // Video URL
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('project');
    }
}
