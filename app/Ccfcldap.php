<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ccfcldap extends Model
{
    //
    protected $table = 'ccfc_ldap';
    protected $fillable = [
        'ldap_username',
        'id_number'
    ];
}
