<?php

namespace App\Models;

use App\Http\Controllers\Traits\FormatDateTrait;
use App\Http\Controllers\Traits\SlugNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    use SlugNameTrait;
    use FormatDateTrait;

    protected $fillable = [
        'total_price',
        'total_order',
        'date',
        'branch_id',
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
