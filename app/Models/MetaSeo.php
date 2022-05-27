<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaSeo extends ModelMPK
{
    use HasFactory;

    protected $primaryKey = ['model_id', 'model_type'];
    public $incrementing = false;
    protected $fillable = [
        'model_id',
        'model_type',
        'title',
        'description',
        'keyword',
    ];
    public $timestamps = true;

    public function model(){
        return $this->morphTo();
    }
}
