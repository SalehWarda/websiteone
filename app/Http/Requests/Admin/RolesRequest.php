<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RolesRequest extends FormRequest
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
                    'name'              => 'required|unique:roles,name',
                    'permissions'              => 'required',

                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name'              => 'required|unique:roles,name,'.$this->role_id,
                    'permissions'              => 'required',

                ];
            }
            default: break;
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'هذا الحقل مطلوب',
            'name.unique' => 'هذا الحقل موجود مسبقا',
            'permissions.required' => 'عليك الإختيار على الأقل صلاحية واحدة',
        ];
    }
}
