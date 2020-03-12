<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeSwimming extends Model
{
    //
    protected $table = 'employee_swimmings';
    protected $fillable = [
        'employee_id_number',
        'or_number',
        'date_time_usage',
        'amount'
    ];
}
