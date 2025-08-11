<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Core\Internationalisation\BaseFormRequest;

class CreateCategoryRequest extends BaseFormRequest
{
    public function rules()
    {
        return [];
    }

    public function translationRules()
    {

        return [
            'title' => 'required',
            'slug' => ['required', Rule::unique('product__category_translations', 'slug')],
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [
            'title.required' => trans('product::categories.validation.title is required'),
            'slug.required' => trans('product::categories.validation.slug is required'),
            'slug.unique' => trans('product::categories.validation.slug is already used')
        ];
    }
}