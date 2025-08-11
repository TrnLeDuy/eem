<?php

namespace Modules\Project\Transformers\Backend;

use Illuminate\Http\Resources\Json\JsonResource;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class FullProjectTransformer extends JsonResource
{
    public function toArray($request)
    {
        $projectData = [
            'id' => $this->resource->id,
            'status' => (bool) $this->resource->status,
            'category_id' => $this->resource->category_id,
        ];

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $supportedLocale) {
            $projectData[$locale] = [];
            foreach ($this->resource->translatedAttributes as $translatedAttribute) {
                $projectData[$locale][$translatedAttribute] = $this->resource->translateOrNew($locale)->$translatedAttribute;
            }
        }
        return $projectData;
    }
}
