<?php
namespace App\Http\Controllers\Traits;

use Carbon\Carbon;

trait FormatDateTrait {
    public function getFormattedCreatedAtAttribute(){
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }
    public function getFormattedUpdatedAtAttribute(){
        return Carbon::parse($this->updated_at)->format('d/m/Y');
    }
}
