<?php

namespace App\Rules;

use App\Services\AliasService;
use Illuminate\Contracts\Validation\Rule;

class ValidateAlias implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !app(AliasService::class)->checkExist($value, [
            'model_id' => \request()->id,
            'model_type' => $this->model,
        ]);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Đường dẫn đã tồn tại. Vui lòng chọn giá trị khác';
    }
}
