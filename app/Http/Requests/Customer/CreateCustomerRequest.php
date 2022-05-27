<?php

namespace App\Http\Requests\Customer;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class CreateCustomerRequest extends FormRequest
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
            'phone' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'phone.required' => 'SDT bắt buộc phải có',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        $message = [];
        foreach ($errors as $key=>$error) {
            $message[] = $errors[$key][0];
        }
        throw new HttpResponseException(response()->json([
            'status'=>  200,
            'message' => $message[0],
            'data' =>[],
            'success' => false,
        ], 200));

    }
}
