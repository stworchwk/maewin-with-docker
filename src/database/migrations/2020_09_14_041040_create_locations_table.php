<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->integer('location_category_id');
            $table->string('code', 20);
            $table->string('title_th', 100);
            $table->string('title_en', 100);
            $table->text('mark_down')->nullable();
            $table->string('village_name', 50)->nullable();
            $table->integer('village_no')->nullable();
            $table->text('address')->nullable();
            $table->string('owner_full_name', 50)->nullable();
            $table->string('tel', 50)->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('latitude', 50);
            $table->string('longitude', 50);
            $table->string('destination_latitude', 50);
            $table->string('destination_longitude', 50);
            $table->float('budget', 8, 2)->nullable();
            $table->integer('time_spent')->nullable();
            $table->tinyInteger('active');
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
        Schema::dropIfExists('locations');
    }
}
