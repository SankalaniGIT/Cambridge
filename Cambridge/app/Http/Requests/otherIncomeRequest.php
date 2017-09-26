<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class otherIncomeRequest extends FormRequest
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
            'type' => 'required',
            'amount' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'Other Income type is required',
            'amount.required' => 'Amount is required',
            'amount.numeric' => 'Amount should be a numeric value'
        ];
    }
}
