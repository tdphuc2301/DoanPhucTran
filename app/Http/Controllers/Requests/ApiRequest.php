<?php
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class ApiRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        $errors = array_map(function($error){
            return $error[0];
        }, $errors);
        
        throw new HttpResponseException(response()->json([
            'message' => $errors,
            'data' =>[],
            'success' => false,
        ], 400));

    }
}