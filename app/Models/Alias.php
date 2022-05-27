<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alias extends ModelMPK
{
    use HasFactory;
    protected $table = 'alias';
    protected $primaryKey = ['model_id', 'model_type'];
    public $incrementing = false;

    protected $fillable = [
        'alias',
        'model_id',
        'model_type',
    ];

    public $timestamps = true;

    public function model()
    {
        return $this->morphTo();
    }
}
