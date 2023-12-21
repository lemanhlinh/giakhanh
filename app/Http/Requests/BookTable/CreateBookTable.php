<?php

namespace App\Http\Requests\BookTable;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookTable extends FormRequest
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
            'full_name' => 'required',
            'email' => 'nullable',
            'phone' => 'required|numeric|integer|min:8|max:15',
            'store_id' => 'required',
            'floor_id' => 'nullable',
            'table_id' => 'nullable',
            'book_time' => 'required',
            'book_hour' => 'required',
            'number_customers' => 'nullable',
            'note' => 'nullable',
            'status' => 'nullable',
            'admin_note' => 'nullable',
        ];
    }
}
