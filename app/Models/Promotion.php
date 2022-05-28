<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

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

    public function typePromotion()
    {
        $this->belongsTo(TypePromotion::class,'type_promotion_id','id');
    }
}
