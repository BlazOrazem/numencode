<?php

namespace Cms\Http\Requests;

use Numencode\Http\Request;
use Cms\Repositories\UserRepository;

class LoginRequest extends Request
{
    /**
     * Existing user.
     *
     * @var User
     */
    protected $resolvedUser;

    /**
     * Get the validation rules that apply to the login request.
     *
     * @return array
     */
    public function rules()
    {
        $this->customRule('login', 'checkLogin');

        return [
            'email'    => 'required|email',
            'password' => 'required|login'
        ];
    }

    /**
     * Validate user login.
     *
     * @param UserRepository $repository
     * @return bool
     */
    public function checkLogin(UserRepository $repository)
    {
        if ($this->email && $this->password) {
            $this->resolvedUser = $repository->getByLogin($this->email, $this->password);

            return !empty($this->resolvedUser);
        }

        return true;
    }

    /**
     * Return existing user.
     *
     * @return object
     */
    public function resolvedUser()
    {
        return $this->resolvedUser;
    }
}
