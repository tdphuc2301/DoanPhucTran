<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
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
            'name' => $this->name,
            'status' => $this->status,
            'address' => $this->address,
            'province_code' => $this->province,
            'district_code' => $this->district_code,
            'ward_code' => $this->ward_code,
            'long' => $this->long,
            'lat' => $this->lat,
            'status_label' => config("common.status_label.$this->status"),
            'formatted_created_at' => $this->formatted_created_at ?? Carbon::parse($this->created_at)->format(config('common.date_format')),
            'formatted_updated_at' => $this->formatted_updated_at ?? Carbon::parse($this->updated_at)->format(config('common.date_format')),
            'images' => $this->relationLoaded('images') ? 
            ImageResource::collection($this->whenLoaded('images'))->toArray($request) : []
        ];
    }
}
