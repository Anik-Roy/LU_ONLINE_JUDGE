<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('session_id');
            $table->integer('problem_id');
            $table->integer('user_id');
            $table->integer('acm')->nullable()->default(0);
            $table->longText('code');
            $table->string('language')->default('c');
            $table->integer('cpu')->default(0);
            $table->integer('memory')->default(0);
            $table->string('result')->nullable()->default('queued');
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
        Schema::dropIfExists('submissions');
    }
}
