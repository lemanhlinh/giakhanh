<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStore extends FormRequest
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
            'phone' => 'nullable',
            'address' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'image_qr' => 'nullable',
            'city_id' => 'nullable',
            'active' => 'nullable',
            'ordering' => 'nullable',
        ];
    }
}
