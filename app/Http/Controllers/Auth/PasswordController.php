<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    /**
     * Where to redirect after successful password reset.
     *
     * @var string
     */
    protected $redirectPath = '/';

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('guest');
    }

    /**
     * TODO not working properly
     * Send password reset link.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function postEmailPassword(Request $request)
    {
        flash()->overlay("Forgotten password", "Password reset link was sent to your email address {$request->email}.\\nPlease check your inbox.", "success");

        return $this->postEmail($request);
    }

    /**
     * TODO not working properly
     * Reset password.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function postResetPassword(Request $request)
    {
        flash()->overlay("Password reset", "Your password was successfully changed.", "success");

        return $this->postReset($request);
    }

}
