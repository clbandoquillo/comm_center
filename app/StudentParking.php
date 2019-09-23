<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentParking extends Model
{
    //
    protected $table = 'student_parking';
    protected $fillable = [
        'id_number',
        'plate_number',
        'or_number',
        'contact_number',
        'license_number',
        'license_expiry_date',
        'schoolyear',
        'semester',
        'parking_type',
        'sticker_number',
        'date_issued'
    ];
}
