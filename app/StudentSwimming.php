<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentSwimming extends Model
{
    //
    protected $table = 'student_swimmings';
    protected $fillable = [
        'student_id_number',
        'or_number',
        'date_time_usage',
        'amount'
    ];
}
