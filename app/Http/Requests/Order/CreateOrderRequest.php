<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\ApiRequest;
use App\Models\Order;
use App\Rules\ValidateAlias;

class CreateOrderRequest extends ApiRequest
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
                new ValidateAlias(Order::class)
            ],
        ];
    }
}
