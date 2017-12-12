<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateInventoryRequest extends FormRequest
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
            'item2'=>'required',
            'Pprice2'=>'required',
            'Sprice2'=>'required',
            'qty2'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'item2.required' => 'Item Name is required',
            'Pprice2.required' => 'Purchase Price is required',
            'Sprice2.required' => 'Selling Price is required',
            'qty2.required' => 'Quantity is required',
        ];
    }
}
