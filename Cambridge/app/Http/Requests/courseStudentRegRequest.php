<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class courseStudentRegRequest extends FormRequest
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
            'First_name'=>'required|max:255',
            'Last_name'=>'required|max:255',
            'DOB'=>'nullable|date',
            'tel'=>'required|digits_between:10,14',
            'nic'=>'nullable|min:10|max:10',
            'address'=>'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'First_name.required' => 'Student First name is required.',
            'Last_name.required' => 'Student Last name is required.',
            'address.required' => 'Address is required.',
            'address.max:255' => 'Address may not be greater than 255 characters.',
            'DOB.date' => 'DOB is not a valid date.',
            'tel.digits_between:10,14' => 'The tell must be between 10 and 14 digits.',
            'tel.required' => 'Telephone No is required.'
        ];
    }
}
