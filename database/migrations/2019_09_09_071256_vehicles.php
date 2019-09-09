<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Vehicles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_number');
            $table->string('owner_name_lto');
            $table->string('relation_to_owner');
            $table->string('make');
            $table->string('model');
            $table->string('plate_number');
            $table->string('color');
            $table->date('reg_expiry_date');
            $table->tinyInteger('lto_cr');
            $table->tinyInteger('lto_or');
            $table->tinyInteger('user_id');
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
        //
    }
}
