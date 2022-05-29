<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public CONST paid = 3;
    public CONST unpaid   = 1;
    public CONST payment_failed    = 2;
    
    
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'payment_code',
        'order_id',
        'payment_method_id',
        'paid',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s',
        'updated_at' => 'datetime:Y-m-d h:i:s',
    ];
}
