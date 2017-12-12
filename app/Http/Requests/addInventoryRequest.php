<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addInventoryRequest extends FormRequest
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
            'item'=>'required',
            'Pprice'=>'required',
            'Sprice'=>'required',
            'qty'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'item.required' => 'Item Name is required',
            'Pprice.required' => 'Purchase Price is required',
            'Sprice.required' => 'Selling Price is required',
            'qty.required' => 'Quantity is required',
        ];
    }
}
