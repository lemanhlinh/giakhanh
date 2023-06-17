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
            'category_id' => 'required',
            'content' => 'required',
            'date' => 'required',
            'status' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png',
            'seo_title' => 'required',
            'seo_keyword' => 'required',
            'seo_description' => 'required',
        ];
    }
}
