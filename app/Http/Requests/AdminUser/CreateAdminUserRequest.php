<?php

namespace App\Http\Requests\AdminUser;

use App\Http\Requests\ApiRequest;
use App\Models\Category;
use App\Models\User;
use App\Rules\ValidateAlias;

class CreateAdminUserRequest extends ApiRequest
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
                new ValidateAlias(User::class)
            ],
        ];
    }
}
