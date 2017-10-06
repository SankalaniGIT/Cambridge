<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class payFeeRequest extends FormRequest
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
            'name' => 'required',
            'class' => 'required',
            'OutStandingAmt' => 'required',
            'year' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Student Name is required.',
            'class.required' => 'Class is required.',
            'OutStandingAmt.required' => 'Outstanding Amount For this year is required.',
            'year.required' => 'Payment Year is required.',
            'year.numeric' => 'Payment Year should be a numeric value.'
        ];
    }
}
