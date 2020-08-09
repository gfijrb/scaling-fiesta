<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ReadProductRequest extends FormRequest
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
            "col" => [
                "string",
                "regex:/^(id|title|price|seller)$/"
            ],
            "dir" => [
                "string",
                "regex:/^(asc|desc)$/"
            ],
        ];
    }
}
