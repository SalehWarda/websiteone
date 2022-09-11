<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
                    'code'              => 'required|unique:coupons,code',
                    'type'              => 'required',
                    'value'             => 'required',
                    'description'       => 'nullable',
                    'use_times'         => 'required|numeric',
                    'start_date'        => 'nullable|date_format:Y-m-d',
                    'expire_date'       => 'required_with:start_date|date_format:Y-m-d',
                    'status'            => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'code'              => 'required|unique:coupons,code,'.$this->coupon_id,
                    'type'              => 'required',
                    'value'             => 'required',
                    'description'       => 'nullable',
                    'use_times'         => 'required|numeric',
                    'start_date'        => 'nullable|date_format:Y-m-d',
                    'expire_date'       => 'required_with:start_date|date_format:Y-m-d',
                    'status'            => 'required',
                ];
            }
            default: break;
        }
    }

    public function attributes()
    {
        return [

        ];
    }
}
