<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class studentInsertRequest extends FormRequest
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
            'First_name'=>'string|required|max:255',
            'Last_name'=>'string|required|max:255',
            'DOB'=>'required|date',
            'Father_First_name'=>'nullable|string|max:255',
            'Father_Last_name'=>'nullable|string|max:255',
            'Father_tell'=>'nullable|digits_between:10,14',
            'Mother_First_name'=>'nullable|string|max:255',
            'mLname'=>'nullable|string|max:255',
            'Mother_tell'=>'nullable|digits_between:10,14',
            'Tell'=>'required|digits_between:10,14',
            'Address'=>'max:255'
        ];
    }

    public  function messages()
    {
        return [
            'mLname.max:255'=>'The Mother Last Name may not be greater than 255 characters.'
        ];
    }
}
