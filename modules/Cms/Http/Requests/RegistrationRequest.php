<?php

namespace Cms\Http\Requests;

use Numencode\Http\Request;

class RegistrationRequest extends Request
{
    /**
     * Get the validation rules that apply to the registration request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'     => 'required|max:255',
            'nickname' => 'max:255|unique:users',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'avatar'   => 'mimes:jpg,jpeg,png,gif,bmp',
        ];
    }
}
