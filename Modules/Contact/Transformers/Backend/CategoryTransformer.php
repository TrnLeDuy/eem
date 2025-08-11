<?php

namespace Modules\Contact\Transformers\Backend;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryTransformer extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'status' => (bool) $this->resource->status,
            'created_at' => $this->resource->created_at->format('d-m-Y H:i'),
            'translations' => [
                'title' => optional($this->resource->translate(locale()))->title,
            ],
            'urls' => [
                'delete_url' => route('api.contact.category.destroy', $this->resource->id),
            ],
        ];
    }
}
