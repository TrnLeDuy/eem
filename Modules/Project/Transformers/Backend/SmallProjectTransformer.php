<?php

namespace Modules\Project\Transformers\Backend;

use Illuminate\Http\Resources\Json\JsonResource;

class SmallProjectTransformer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
        ];
    }
}
