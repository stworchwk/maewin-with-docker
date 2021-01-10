<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('plan_id');
            $table->tinyInteger('type');
            $table->dateTime('date_time');
            $table->string('title', 100);
            $table->string('detail', 150);
            $table->string('latitude', 50);
            $table->string('longitude', 50);
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
        Schema::dropIfExists('plan_logs');
    }
}
