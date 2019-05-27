<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id');
            $table->integer('author_id');
            $table->integer('session_id');
            $table->string('title');
            $table->string('level');
            $table->integer('acm')->nullable()->default(0);
            $table->integer('time_limit');
            $table->integer('memory_limit');
            $table->longText('body');
            $table->longText('input_sec');
            $table->longText('output_sec');
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
        Schema::dropIfExists('problems');
    }
}
