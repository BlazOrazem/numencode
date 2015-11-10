<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationException;

abstract class Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request - defaults to true.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request - defaults to empty rule set.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * Extend validator with additional custom rules.
     *
     * @param $rule
     * @param $method
     */
    public function customRule($rule, $method)
    {
        Validator::extend($rule, function($attribute, $value, $parameters) use ($method) {
            return app()->call([$this, $method], compact('attribute', 'value', 'parameters'));
        });
    }

}
