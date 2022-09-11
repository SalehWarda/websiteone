<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PaymentMethodRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'name' => 'required|max:255',
                    'code' => 'required|max:255|unique:payment_methods,code',
                    'driver_name' => 'nullable',
                    'merchant_email' => 'nullable|email',
                    'username' => 'nullable',
                    'password' => 'nullable',
                    'secret' => 'nullable',
                    'sandbox_merchant_email' => 'nullable',
                    'sandbox_username' => 'nullable',
                    'sandbox_password' => 'nullable',
                    'sandbox_secret' => 'nullable',
                    'sandbox' => 'nullable',
                    'status' => 'required',

                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required|max:255',
                    'code' => 'required|max:255|unique:payment_methods,code,'.$this->payment_id,
                    'driver_name' => 'nullable',
                    'merchant_email' => 'nullable|email',
                    'username' => 'nullable',
                    'password' => 'nullable',
                    'secret' => 'nullable',
                    'sandbox_merchant_email' => 'nullable',
                    'sandbox_username' => 'nullable',
                    'sandbox_password' => 'nullable',
                    'sandbox_secret' => 'nullable',
                    'sandbox' => 'nullable',
                    'status' => 'required',
                ];
            }
            default: break;
        }
    }
}
