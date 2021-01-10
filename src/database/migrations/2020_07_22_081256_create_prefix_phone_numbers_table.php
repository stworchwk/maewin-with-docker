<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrefixPhoneNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prefix_phone_numbers', function (Blueprint $table) {
            $table->id();
            $table->string('prefix', 5);
            $table->string('name_th', 100);
            $table->string('name_en', 100);
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
        Schema::dropIfExists('prefix_phone_numbers');
    }
}
