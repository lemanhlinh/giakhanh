<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoreFloorDesk extends FormRequest
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
            'name' => 'required',
            'number_desk' => 'nullable',
            'store_id' => 'required',
            'store_floor_id' => 'required',
            'type' => 'nullable',
            'active' => 'nullable',
        ];
    }
}
