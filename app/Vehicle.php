<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    //
    protected $table = 'vehicles';
    protected $fillable = [
        'id_number',
        'owner_name_lto',
        'relation_to_owner',
        'make',
        'model',
        'plate_number',
        'color',
        'reg_expiry_date',
        'lto_cr',
        'lto_or'
    ];
}
