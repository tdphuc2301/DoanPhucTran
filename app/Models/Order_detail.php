<?php

namespace App\Models;

use App\Http\Controllers\Traits\FormatDateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
    use FormatDateTrait;

    protected $table = 'order_details';

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'status',
        
    ];
    protected $appends = [
        'formatted_created_at',
        'formatted_updated_at',
    ];

    public $timestamps = true;
    

    
}
