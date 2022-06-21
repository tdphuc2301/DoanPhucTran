<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_branch extends Model
{
    use HasFactory;

    protected $table = 'product_branchs';

    protected $fillable = [
        'product_id',
        'branch_id',
        'stock_quantity',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s',
        'updated_at' => 'datetime:Y-m-d h:i:s',
    ];
}
