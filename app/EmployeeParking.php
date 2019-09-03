<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeParking extends Model
{
    //
    protected $table = 'employee_parking';
    protected $fillable = [
        'id_number',
        'school_dept_office',
        'contact_number',
        'license_number',
        'license_expiry_date',
        'schoolyear',
        'semester',
        'parking_type',
        'or_number',
        'sticker_number',
        'date_issued'
    ];
}
