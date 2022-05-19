<?php
namespace App\Http\Controllers\Traits;

trait LogTimeTrait
{
    public static function bootLogTimeTrait()
    {
        static::creating(function ($item) {
            if (!$item->create_at) {
                $item->create_at = time();
            }
            if (!$item->update_at) {
                $item->update_at = time();
            }
        });

        static::updating(function ($item) {
            $item->create_at = time();
            $item->update_at = time();
        });
    }
}
