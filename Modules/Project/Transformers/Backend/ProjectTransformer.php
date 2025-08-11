<?php

namespace Modules\Project\Transformers\Backend;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectTransformer extends JsonResource
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
            'updated_at' => $this->resource->updated_at->format('d-m-Y'),
            'translations' => [
                'title' => optional($this->resource->translate(locale()))->title,
                'slug' => optional($this->resource->translate(locale()))->slug,
            ],
            'urls' => [
                'delete_url' => route('api.project.project.destroy', $this->resource->id),
            ],
        ];
    }
}

