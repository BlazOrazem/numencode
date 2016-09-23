<?php

namespace Cms\Http\Requests;

use Illuminate\Auth\Passwords\TokenRepositoryInterface;

class ResetPasswordRequest extends ResetRequest
{
    /**
     * Existing user.
     *
     * @var User
     */
    protected $resolvedUser;

    /**
     * Get the validation rules that apply to the reset password request.
     *
     * @return array
     */
    public function rules()
    {
        $this->customRule('reset', 'checkEmail');
        $this->customRule('token', 'checkToken');

        return [
            'token' => 'required',
            'email' => 'required|email|reset|token',
            'password' => 'required|min:4',
            'password_confirmation' => 'required|same:password',
        ];
    }

    /**
     * Validate password reset token.
     *
     * @param TokenRepositoryInterface $tokens
     * @return bool
     */
    public function checkToken(TokenRepositoryInterface $tokens)
    {
        return $tokens->exists($this->resolvedUser, $this->token);
    }
}
