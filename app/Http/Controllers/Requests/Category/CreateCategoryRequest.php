<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\ApiRequest;
use App\Models\Category;
use App\Rules\ValidateAlias;

class CreateCategoryRequest extends ApiRequest
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
                new ValidateAlias(Category::class)
            ],
        ];
    }
}
