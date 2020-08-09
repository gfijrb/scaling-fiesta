<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'title'     => 'required|string|min:3|max:100',
            'price'  => 'required|numeric|min:0.01|max:1000000.00',
            'discount'    => 'required|numeric|min:0.00|max:99.90',
            'description'  => 'required|string|min:10|max:1000',
            'categories'     => [
                'required',
                'string',
                'max:20',
                'regex:/^[0-9,]*(1)$/'
            ],
        ];
    }
}
