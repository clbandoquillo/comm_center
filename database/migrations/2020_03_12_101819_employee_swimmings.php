<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmployeeSwimmings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('employee_swimmings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employee_id_number');
            $table->string('or_number');
            $table->string('swimming_type');
            $table->dateTime('date_time_usage', 0);
            $table->double('amount', 8, 2);
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