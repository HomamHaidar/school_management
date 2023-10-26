<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSection extends FormRequest
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


    public function rules()
    {
        return [
            "Name_Section_Ar" => 'required',
            "Name_Section_En" => 'required',
            "Grade_id" => 'required',
            "Class_id" => 'required',

        ];
    }
    public function messages()
    {
        return [
            "Name_Section_Ar.required"  => trans('validation.required'),
            "Name_Section_En.required"  => trans('validation.required'),
            "Grade_id.required"   => trans('validation.required'),
            "Class_id.required"   => trans('validation.required'),


        ];
    }
}
