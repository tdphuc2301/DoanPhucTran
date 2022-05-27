<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'index' => $this->index,
            'description' => $this->description,
            'search' => $this->search,
            'status' => $this->status,
            'status_label' => config("common.status_label.$this->status"),
            'formatted_created_at' => $this->formatted_created_at ?? Carbon::parse($this->created_at)->format(config('common.date_format')),
            'formatted_updated_at' => $this->formatted_updated_at ?? Carbon::parse($this->updated_at)->format(config('common.date_format')),
            'images' => $this->relationLoaded('images') ? 
            ImageResource::collection($this->whenLoaded('images'))->toArray($request) : []
        ];
    }
}
