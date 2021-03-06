<?php

namespace Cms\Http\Auth;

use Cms\Http\BaseController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends BaseController
{
    use ResetsPasswords;

    /**
     * Where to redirect after successful password reset.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param \Illuminate\Http\Request $request Request
     * @param string|null              $token   Token
     *
     * @return \Illuminate\Http\Response
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('theme::auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param Request $request  Request
     * @param string  $response Response
     *
     * @return \Illuminate\Http\Response
     */
    protected function sendResetResponse(Request $request, $response)
    {
        flash()->overlay(
            trans('theme::messages.password_reset_title'),
            trans('theme::messages.password_reset_success'),
            'success'
        );

        return redirect($this->redirectTo);
    }
}
