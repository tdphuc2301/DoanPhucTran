<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\ApiRequest;
use App\Models\Post;
use App\Rules\ValidateAlias;

class CreatePostRequest extends ApiRequest
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
                new ValidateAlias(Post::class)
            ],
            'short_content' => 'nullable|string|max:255',
            'content' => 'required|string',
        ];
    }
}
