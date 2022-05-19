<?php
namespace App\Http\Controllers\Traits;
trait AddressRelation {
    public function province(){
        return $this->belongsTo('App\Models\Province','province_id','id');
    }

    public function district(){
        return $this->belongsTo('App\Models\District','district_id','id');
    }
    public function ward(){
        return $this->belongsTo('App\Models\Ward','ward_id','id');
    }
}
