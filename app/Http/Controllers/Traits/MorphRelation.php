<?php
namespace App\Http\Controllers\Traits;

use App\Models\Alias;
use App\Models\Image;
use App\Models\MetaSeo;

trait MorphRelation {
    public function alias(){
        return $this->morphOne(Alias::class,'model');
    }

    public function metaseo(){
        return $this->morphOne(MetaSeo::class,'model');
    }

    public function images(){
        return $this->morphMany(Image::class,'model');
    }
}
