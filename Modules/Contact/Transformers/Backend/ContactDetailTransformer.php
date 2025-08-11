<?php

namespace Modules\Contact\Transformers\Backend;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Product\Transformers\Backend\SmallProductTransformer;


class ContactDetailTransformer extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'contact_id' => $this->resource->contact_id,
            'product_id' => $this->resource->product_id,
            'messages' => $this->resource->messages,
            'assembly_address' => $this->resource->assembly_address,
            'monthly_consumption_kwh' => $this->resource->monthly_consumption_kwh,
            'avg_monthly_cost_vnd' => $this->resource->avg_monthly_cost_vnd,
            'financial_capacity_kw' => $this->resource->financial_capacity_kw,
            'avl_roof_area_m2' => $this->resource->avl_roof_area_m2,
            'power_phase_count' => $this->resource->power_phase_count,
            'product' => new SmallProductTransformer($this->resource->product)
        ];
    }
}


