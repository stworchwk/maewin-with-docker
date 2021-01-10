<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_requests', function (Blueprint $table) {
            $table->id();
            $table->string('title_th', 100);
            $table->string('title_en', 100);
            $table->string('detail_th', 150)->nullable();
            $table->string('detail_en', 150)->nullable();
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
        Schema::dropIfExists('check_requests');
    }
}
