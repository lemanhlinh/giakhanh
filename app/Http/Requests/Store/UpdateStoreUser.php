<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoreUser extends FormRequest
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
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:8|max:15',
            'status' => 'required',
            'type' => 'required',
            'gender' => 'required',
            'active' => 'required',
        ];
    }
}
