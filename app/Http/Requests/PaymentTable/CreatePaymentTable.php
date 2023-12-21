<?php

namespace App\Http\Requests\PaymentTable;

use Illuminate\Foundation\Http\FormRequest;

class CreatePaymentTable extends FormRequest
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
            'phone' => 'required',
            'voucher' => 'nullable',
            'store_id' => 'required',
            'table_id' => 'nullable',
        ];
    }
}
