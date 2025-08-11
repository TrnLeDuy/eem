<?php

namespace Modules\Contact\Transformers\Backend;

use Illuminate\Http\Resources\Json\JsonResource;    
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class FullCategoryTransformer extends JsonResource
{
    public function toArray($request)
    {
        $categoryData = [
            'id' => $this->resource->id,
            'status' => (bool) $this->resource->status,
            'created_at' => $this->resource->created_at->format('d-m-Y H:i'),
        ];

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $supportedLocale) {
            $categoryData[$locale] = [];
            foreach ($this->resource->translatedAttributes as $translatedAttribute) {
                $categoryData[$locale][$translatedAttribute] = $this->resource->translateOrNew($locale)->$translatedAttribute;
            }
        }
        return $categoryData;
    }
}
