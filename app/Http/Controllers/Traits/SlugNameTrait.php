<?php
namespace App\Http\Controllers\Traits;
use Illuminate\Support\Str;

trait SlugNameTrait
{
    public static function bootSlugNameTrait()
    {
        static::creating(function ($item) {
            $item->search = Str::slug($item->name, ' ');
        });

        static::updating(function ($item) {
            $item->search = Str::slug($item->name, ' ');
        });
    }
}
