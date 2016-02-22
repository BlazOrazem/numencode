<?php

namespace Admin\Http\Requests;

use Numencode\Http\Request;
use Illuminate\Support\Facades\Route;

class ManagerUpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the manager profile update request.
     *
     * @return array
     */
    public function rules()
    {
        $manager = Route::current()->parameters()['manager'];
    
        return [
            'name'     => 'required|max:255',
            'email'    => $this->email == $manager->email ? '' : 'required|email|max:255|unique:users',
            'password' => empty($this->password) ? '' : 'required|min:6',
//            'avatar'   => 'mimes:jpg,jpeg,png,gif,bmp',
        ];
    }
}
