<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'image' => 'required_if:type,file|image|mimes:jpg,jpeg,png',
            'slug' => 'nullable',
            'active' => 'required|numeric|integer|min:0',
            'seo_title' => 'nullable',
            'seo_keyword' => 'nullable',
            'seo_description' => 'nullable',
        ];
    }
}
