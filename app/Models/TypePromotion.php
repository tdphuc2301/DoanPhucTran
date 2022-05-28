<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePromotion extends Model
{
    use HasFactory;

    protected $table = 'type_promotions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Relation with user
     *
     * @return void
     */
    public function promotion()
    {
        $this->hasMany(Promotion::class);
    }
}
