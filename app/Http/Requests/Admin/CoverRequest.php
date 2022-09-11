<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CoverRequest extends FormRequest
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
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'field_one_ar'                     => 'required|max:100000,'.$this->cover_id,
                    'field_one_en'                     => 'required|max:100000,'.$this->cover_id,
                    'field_tow_ar'                   => 'required|max:100000,'.$this->cover_id,
                    'field_tow_en'                   => 'required|max:100000,'.$this->cover_id,
                    'field_three_ar'                   => 'required|max:100000,'.$this->cover_id,
                    'field_three_en'                   => 'required|max:100000,'.$this->cover_id,
                    'title_ar'                   => 'required|max:100000,'.$this->cover_id,
                    'title_en'                   => 'required|max:100000,'.$this->cover_id,

                ];
            }
            default: break;
        }
    }

    public function attributes()
    {
        return [

            'field_one_ar' =>'first field',
            'field_one_en' =>'first field',
            'field_tow_ar' =>'second field',
            'field_tow_en' =>'second field',
            'field_three_ar' =>'third field',
            'field_three_en' =>'third field',

        ];
    }
}
