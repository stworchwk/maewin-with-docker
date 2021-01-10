<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_trackings', function (Blueprint $table) {
            $table->id();
            $table->integer('plan_id');
            $table->string('latitude', 50);
            $table->string('longitude', 50);
            $table->dateTime('tracking_date_time');
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
        Schema::dropIfExists('plan_trackings');
    }
}
