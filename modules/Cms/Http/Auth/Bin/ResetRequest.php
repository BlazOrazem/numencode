<?php

namespace Cms\Http\Requests;

use Numencode\Http\Request;
use Cms\Repositories\UserRepository;

class ResetRequest extends Request
{
    /**
     * Existing user.
     *
     * @var User
     */
    protected $resolvedUser;

    /**
     * Get the validation rules that apply to the reset request.
     *
     * @return array
     */
    public function rules()
    {
        $this->customRule('reset', 'checkEmail');

        return [
            'email' => 'required|email|reset',
        ];
    }

    /**
     * Validate user's email.
     *
     * @param UserRepository $repository
     * @return bool
     */
    public function checkEmail(UserRepository $repository)
    {
        if ($this->email) {
            $this->resolvedUser = $repository->getByEmail($this->email);

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
