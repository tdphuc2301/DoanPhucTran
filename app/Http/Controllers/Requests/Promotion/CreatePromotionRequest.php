<?php

namespace App\Http\Requests\Promotion;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CreatePromotionRequest extends FormRequest
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
            'code' => 'required',
            'value' => 'required',
            'type' => ['required',Rule::in(['percent', 'money'])],
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Mã voucher bắt buộc phải có',
            'type.required' => 'Vui lòng chọn loại khuyến mãi',
            'value.required' => 'Vui lòng nhập trị giá khuyến mãi',
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
