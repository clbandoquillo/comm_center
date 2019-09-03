<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    //
    protected $fillable = [
        'services_name', 'category_id', 'price', 'schoolyear', 'semester'
    ];

    public function ccfc_categories(){
        return $this->hasMany(CcfcCategory::class);
    }
}
