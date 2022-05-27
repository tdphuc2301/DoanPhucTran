<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\ApiRequest;
use App\Models\Product;
use App\Rules\ValidateAlias;

class CreateProductRequest extends ApiRequest
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
            'alias' => [
                'bail',
                'required',
                new ValidateAlias(Product::class)
            ],
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'bail|required|integer|min:0',
            'sale_off_price' => 'bail|nullable|sometimes|integer|min:0',
            'rate' => 'bail|nullable|sometimes|integer|min:0|max:5',
            'total_rate' => 'bail|nullable|sometimes|integer|min:0|max:5',
        ];
    }
}
