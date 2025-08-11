<?php

namespace Modules\Product\Transformers\Backend;

use Illuminate\Http\Resources\Json\JsonResource;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class FullProductTransformer extends JsonResource
{
    public function toArray($request)
    {
        $product = [
            'id' => $this->resource->id,
            'status' => (bool) $this->resource->status,
            'is_promotion' => (bool) $this->resource->is_promotion,
            'show_homepage' => (bool) $this->resource->show_homepage,
            'product_status' => $this->resource->product_status,
            'code' => $this->resource->code,
            'price' => $this->resource->price,
            'price_sale' => $this->resource->price_sale,
            'rating' => $this->resource->rating,
            'category_id' => $this->resource->category_id
        ];

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $supportedLocale) {
            $product[$locale] = [];
            foreach ($this->resource->translatedAttributes as $translatedAttribute) {
                $product[$locale][$translatedAttribute] = $this->resource->translateOrNew($locale)->$translatedAttribute;
            }
        }
        return $product;
    }
}