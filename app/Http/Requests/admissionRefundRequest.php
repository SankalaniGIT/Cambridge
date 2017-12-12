<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class admissionRefundRequest extends FormRequest
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
            'adNo' => 'required',
            'name' => 'required',
            'class' => 'required',
            'amount' => 'required',
            'discount' => 'nullable|numeric',
            '1stPart' => 'nullable|numeric',
            '2ndPart' => 'nullable|numeric'
        ];
    }

    public function messages()
    {
        return [
            'adNo.required' => 'Admission No is required',
            'name.required' => 'Student Name is required',
            'class.required' => 'Class is required',
            'amount.required' => 'Fees required',
            'discount.numeric' => 'Discount should be a numeric value',
            '1stPart.numeric' => 'Admission fee 1st Part should be a numeric value',
            '2ndPart.numeric' => 'Admission fee 2nd Part should be a numeric value',
        ];
    }

}
