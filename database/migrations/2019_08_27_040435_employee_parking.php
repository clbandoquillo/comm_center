<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmployeeParking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_parking', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_number');
            $table->string('or_number');
            $table->string('contact_number');
            $table->string('school_dept_office')->nullable();
            $table->string('license_number');
            $table->date('license_expiry_date');
            $table->string('schoolyear');
            $table->tinyInteger('semester');
            $table->string('parking_type');
            $table->string('sticker_number')->nullable();
            $table->date('date_issued')->nullable();
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
        Schema::dropIfExists('employee_parking');
    }
}
