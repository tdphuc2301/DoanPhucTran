<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'name' => $this->name,
            'code' => $this->code,
            'index' => $this->index,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'search' => $this->search,
            'price' => $this->price,
            'sale_off_price' => $this->sale_off_price,
            'rate' => $this->rate,
            'total_rate' => $this->total_rate,
            'status' => $this->status,
            'status_label' => config("common.status_label.$this->status"),
            'formatted_created_at' => $this->formatted_created_at ?? Carbon::parse($this->created_at)->format(config('common.date_format')),
            'formatted_updated_at' => $this->formatted_updated_at ?? Carbon::parse($this->updated_at)->format(config('common.date_format')),
            'images' => $this->relationLoaded('images') ?
                ImageResource::collection($this->whenLoaded('images'))->toArray($request) : [],
            'category' => $this->relationLoaded('category') ? $this->category : null
        ];
    }
}
