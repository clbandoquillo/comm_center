<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentSwimming extends Model
{
    //
    protected $table = 'student_swimming';
    protected $fillable = [
        'student_id_number',
        'or_number',
        'swimming_type',
        'totalHrs',
        'schoolyear',
        'semester',
        'date_time_usage',
        'amount'
    ];
}
