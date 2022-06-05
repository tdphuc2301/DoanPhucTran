<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class WebResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $alias = $this->alias;
        setlocale(LC_MONETARY, 'en_IN');
        
        return [
            'id' => $this->id,
            'category_id' => $this->category,
            'rom_id' => $this->rom,
            'ram_id' => $this->ram,
            'brand_id' => $this->brand,
            'name' => $this->name,
            'price' => number_format($this->price),
            'sale_off_price' => number_format($this->sale_off_price) ,
            'rate' => $this->rate,
            'total_rate' => $this->total_rate,
            'images' => $this->relationLoaded('images') ?
                ImageResource::collection($this->whenLoaded('images'))->toArray($request) : [],
            'alias' => $alias->alias,
            'percentPromotion' => round(($this->price -$this->sale_off_price)*100/$this->price,1)
        ];
    }

    public function toConvertPaid($paid)
    {
        $stringPaid ='';
        if($paid == 1) {
            $stringPaid =  "Chưa thanh toán";
        } else if($paid == 2) {
            $stringPaid = 'Thanh toán thất bại';
        } else if($paid == 3) {
            $stringPaid = 'Thanh toán thành công';
        }
        return $stringPaid;
    }
}
