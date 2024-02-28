<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrder extends FormRequest
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
            'phone' => [
                'required',
                'regex:/^(0|\+84)[0-9]{9,10}$/'
            ],
            'address' => 'required',
            'gender' => 'required',
            'note' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'Vui lòng nhập Họ tên.',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'address.required' => 'Địa chỉ là bắt buộc.',
            'phone.regex' => 'Số điện thoại không hợp lệ. Vui lòng nhập số điện thoại bắt đầu bằng số 0 và có 9-10 chữ số.'
        ];
    }
}
