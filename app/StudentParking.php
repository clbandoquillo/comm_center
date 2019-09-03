<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentParking extends Model
{
    //
    protected $fillable = [
        'student_id',
        'contact_number',
        'isUndergrad',
        'isGrad',
        'license_number',
        'license_expiry_date',
        'schoolyear',
        'date_issued'
    ];
}
