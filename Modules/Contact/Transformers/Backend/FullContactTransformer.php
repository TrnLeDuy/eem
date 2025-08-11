<?php

namespace Modules\Contact\Transformers\Backend;

use Illuminate\Http\Resources\Json\JsonResource;

class FullContactTransformer extends JsonResource
{
    public function toArray($request)
    {
        $contactData = [
            'id' => $this->resource->id,
            'type_id' => $this->resource->type_id,
            'contact_code' => $this->resource->contact_code,
            'contact_name' => $this->resource->contact_name,
            'contact_title' => $this->resource->contact_title,
            'note' => $this->resource->note,
            'email' => $this->resource->email,
            'phone_number' => $this->resource->phone_number,
            'status' => $this->resource->status,
            'created_at' => $this->resource->created_at->format('d-m-Y H:i'),
            'categories'  =>  new CategoryTransformer($this->resource->categories),
            'contactDetail' => $this->resource->contactDetail ? new ContactDetailTransformer($this->resource->contactDetail) : null,
        ];

        return $contactData;
    }
}   
