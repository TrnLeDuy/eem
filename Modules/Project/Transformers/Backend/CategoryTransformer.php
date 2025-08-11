<?php

namespace Modules\Project\Transformers\Backend;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryTransformer extends JsonResource
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
            'status' => (bool) $this->resource->status,
            'created_at' => $this->resource->created_at->format('d-m-Y'),
            'translations' => [
                'title' => optional($this->resource->translate(locale()))->title,
                'slug' => optional($this->resource->translate(locale()))->slug,
            ],
            'urls' => [
                'delete_url' => route('api.project.category.destroy', $this->resource->id),
            ],
        ];
    }
}
