<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\ResetRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
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
     * Page with password reset request form.
     *
     * @return \Illuminate\View\View
     */
    public function getEmail()
    {
        return view('auth.password');
    }

    /**
     * Send email with password reset link.
     *
     * @param ResetRequest $request
     * @param UserRepository $repository
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEmail(ResetRequest $request, UserRepository $repository)
    {
        $user = $request->resolvedUser();

        $repository->resetPassword($user);

        flash()->overlay("Forgotten password",
            "Password reset link was sent to your email address {$request->email}.\\nPlease check your inbox.", "success");

        return redirect('/');
    }

    /**
     * Page with password reset form.
     *
     * @param string $token
     * @return \Illuminate\View\View
     */
    public function getPassword($token)
    {
        return view('auth.reset')->with('token', $token);
    }

    /**
     * Change user's password.
     *
     * @param ResetPasswordRequest $request
     * @param UserRepository $repository
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postPassword(ResetPasswordRequest $request, UserRepository $repository)
    {
        $repository->changePassword($request->resolvedUser(), $request->password);

        $repository->login($request->resolvedUser());

        flash()->overlay("Password reset", "Your password was successfully changed.", "success");

        return redirect('/');
    }
}
