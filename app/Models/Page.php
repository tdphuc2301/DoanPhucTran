<?php

namespace App\Models;

use App\Http\Controllers\Traits\MetaSeoAliasRelation;
use App\Http\Controllers\Traits\MorphRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    use MorphRelation;

    protected $fillable = [
        'name',
        'type',
        'short_content',
        'content',
        'search',
        'status',
    ];
    public $timestamps = true;
}
