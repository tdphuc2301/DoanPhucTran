<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color_product extends Model
{
    use HasFactory;

    protected $table = 'color_products';

    protected $fillable = [
        'product_id',
        'color_id',
    ];

    protected $appends = [
        'formatted_created_at',
        'formatted_updated_at',
    ];

    public $timestamps = true;

    public function alias(){
        return $this->morphOne(Alias::class,'model');
    }

    public function metaseo(){
        return $this->morphOne(MetaSeo::class,'model');
    }

    public function images(){
        return $this->morphMany(Image::class,'model');
    }

    public function getImagesByIndex(array $indexs){
        return $this->images()->whereIn('index', $indexs)->get();
    }
}
