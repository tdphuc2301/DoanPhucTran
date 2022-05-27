<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = 'images';
    protected $fillable = [
        'model_id',
        'model_type',
        'type',
        'width',
        'height',
        'path',
        'index',
        'size',
    ];

    public $timestamps = true;

    public function model(){
        return $this->morphTo();
    }
}
