<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class CreateArticle extends FormRequest
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
            'slug' => 'nullable',
            'category_id' => 'required',
            'content' => 'nullable',
            'active' => 'required',
            'is_home' => 'required',
            'description' => 'required',
            'type' => 'required',
            'ordering' => 'nullable',
            'image' => 'required_if:type,file|image|mimes:jpg,jpeg,png',
            'seo_title' => 'nullable',
            'seo_keyword' => 'nullable',
            'seo_description' => 'nullable',
        ];
    }
}
