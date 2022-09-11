<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AboutRequest extends FormRequest
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
                    'name_ar'                     => 'required|max:255,'.$this->about_id,
                    'name_en'                     => 'required|max:255,'.$this->about_id,
                    'degree_ar'                   => 'required|max:255,'.$this->about_id,
                    'degree_en'                   => 'required|max:255,'.$this->about_id,
                    'address_ar'                   => 'required|max:255,'.$this->about_id,
                    'address_en'                   => 'required|max:255,'.$this->about_id,
                    'email'                        => 'required|email|max:255,'.$this->about_id,
                    'mobile'                        => 'required|max:255,'.$this->about_id,
                    'bio_ar'                      => 'required|max:100000,'.$this->about_id,
                    'bio_en'                      => 'required|max:100000,'.$this->about_id,
                    'education_ar'                => 'required|max:100000,'.$this->about_id,
                    'education_en'                => 'required|max:100000,'.$this->about_id,
                    'experiences_ar'              => 'required|max:100000,'.$this->about_id,
                    'experiences_en'              => 'required|max:100000,'.$this->about_id,
                    'goals_ar'                    => 'required|max:100000,'.$this->about_id,
                    'goals_en'                    => 'required|max:100000,'.$this->about_id,



                ];
            }
            default: break;
        }
    }

    public function attributes()
    {
        return [

            'name_ar' =>'name',
            'name_en' =>'name',
            'degree_ar' =>'degree',
            'degree_en' =>'degree',
            'address_ar' =>'address',
            'address_en' =>'address',
            'email' =>'email',
            'mobile' =>'mobile',
            'bio_ar' =>'bio',
            'bio_en' =>'bio',
            'education_ar' =>'education',
            'education_en' =>'education',
            'experiences_ar' =>'experiences',
            'experiences_en' =>'experiences',
            'goals_ar' =>'goals',
            'goals_en' =>'goals',
    ];
    }
}
