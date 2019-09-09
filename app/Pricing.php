<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    //
    protected $table = 'pricings';
    protected $fillable = [
        'service_name', 'category_id', 'price', 'schoolyear', 'semester', 'status'
    ];

    public function ccfc_categories(){
        return $this->hasMany(CcfcCategory::class);
    }
}
