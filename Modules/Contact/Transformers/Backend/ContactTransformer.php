<?php

namespace Modules\Contact\Transformers\Backend;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Contact\Transformers\Backend\CategoryTransformer;

class ContactTransformer extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'contact_code' => $this->resource->contact_code,
            'contact_name' => $this->resource->contact_name,
            'contact_title' => $this->resource->contact_title,
            'note' => $this->resource->note,
            'email' => $this->resource->email,
            'phone_number' => $this->resource->phone_number,
            'status' => $this->resource->status,
            'created_at' => $this->resource->created_at->format('d-m-Y H:i'),
            'categories'  =>  new CategoryTransformer($this->resource->categories),
            'urls' => [
                'delete_url' => route('api.contact.contact.destroy', $this->resource->id),
            ],
        ];
    }
}

