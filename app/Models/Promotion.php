<?php

namespace App\Models;

use App\Http\Controllers\Traits\FormatDateTrait;
use App\Http\Controllers\Traits\SlugNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    use FormatDateTrait;
    use SlugNameTrait;

    protected $table = 'promotions';

    protected $fillable = [
        'name',
        'code',
        'type',
        'begin',
        'end',
        'value',
        'type_promotion_id',
        'search',
        'index',
        'description',
        'status',
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

    public function typePromotion()
    {
        $this->belongsTo(TypePromotion::class,'type_promotion_id','id');
    }
}
