<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
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
            'model_id' => $this->model_id,
            'model_type' => $this->model_type,
            'type' => $this->type,
            'width' => $this->width,
            'height' => $this->height,
            'path' => $this->path,
            'index' => $this->index,
            'size' => $this->size,
        ];
    }
}
