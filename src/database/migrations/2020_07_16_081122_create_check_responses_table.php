<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_responses', function (Blueprint $table) {
            $table->id();
            $table->integer('check_request_id');
            $table->string('name_th', 100);
            $table->string('name_en', 100);
            $table->tinyInteger('level');
            $table->integer('skip_time');
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
        Schema::dropIfExists('check_responses');
    }
}
