<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeSwimming extends Model
{
    //
    protected $table = 'employee_swimming';
    protected $fillable = [
        'employee_id_number',
        'or_number',
        'swimming_type',
        'totalHrs',
        'schoolyear',
        'semester',
        'date_time_usage',
        'amount'
    ];
}
