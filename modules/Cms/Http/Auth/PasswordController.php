<?php

namespace Cms\Http\Auth;

use Cms\Http\BaseController;
use Cms\Http\Requests\ResetRequest;
use Cms\Repositories\UserRepository;
use Cms\Http\Requests\ResetPasswordRequest;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends BaseController
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

        $this->middleware('isGuest');
    }

    /**
     * Page with password reset request form.
     *
     * @return \Illuminate\View\View
     */
    public function getEmail()
    {
        return view('theme::auth.password');
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

        flash()->overlay(
            trans('messages.password_reset.forgotten'),
            trans('messages.password_reset.link_sent', ['email' => $request->email]),
            'success'
        );

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
        return view('theme::auth.reset')->with('token', $token);
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

        flash()->overlay(trans('messages.password_reset.title'), trans('messages.password_reset.success'), 'success');

        return redirect('/');
    }
}
