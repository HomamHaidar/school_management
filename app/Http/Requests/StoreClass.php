<?php

namespace App\Http\Requests;

use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreClass extends FormRequest
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
        return [
            'List_Classes.*.Name' => 'required'.$this->id,
            'List_Classes.*.Name_class_en' => 'required'.$this->id,
        ];

    }
    public function messages()
    {
        return [
            'Name.required' => trans('validation.required'),
            'Name_class_en.required' => trans('validation.required'),

        ];
    }
}
