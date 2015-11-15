<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Repositories\UserRepository;

class ResetRequest extends Request
{
    /**
     * Login post resolved user.
     *
     * @var
     */
    protected $resolvedUser;

    /**
     * Get the validation rules that apply to the request.
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
        if($this->email) {
            $this->resolvedUser = $repository->getByEmail($this->email);

            return !empty($this->resolvedUser);
        }

        return true;
    }

    /**
     * Logged in user.
     *
     * @return object
     */
    public function resolvedUser()
    {
        return $this->resolvedUser;
    }
}
