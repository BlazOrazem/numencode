<?php

namespace Cms\Http\Requests;

use Numencode\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends Request
{
    /**
     * Get the validation rules that apply to the profile update request.
     *
     * @return array
     */
    public function rules()
    {
        $user = Auth::user();

        return [
            'name'     => 'required|max:255',
            'nickname' => $this->nickname == $user->nickname ? '' : 'max:255|unique:users',
            'email'    => $this->email == $user->email ? '' : 'required|email|max:255|unique:users',
            'password' => empty($this->password) ? '' : 'required|confirmed|min:6',
            'avatar'   => 'mimes:jpg,jpeg,png,gif,bmp',
        ];
    }
}
