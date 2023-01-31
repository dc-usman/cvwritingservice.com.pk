<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'name'              => 'required|regex:/^[A-Za-z -]+$/|max:255',
            "email"             => "required",
            'phone'             => 'required|regex:/^[+][0-9]/|max:20',
            'country'           => 'required',
            'career_level'      => 'required',
            'package'           => 'nullable',
            "detail"            => "nullable",
            "emailAttachments.*"              => 'nullable|file|mimes:pdf,ppt,pptx,doc,docx,jpeg,jpg,png,zip,rar|max:250000',
        ];
    }

    public function messages()
    {
        return [
            // 'carrer_level.required' => 'The career level field is required.',
            // 'deadline_id.required' => 'The deadline field is required.',
        ];
    }
}
