<?php

namespace Cms\Http\Auth;

use Numencode\Models\User;
use Cms\Mailers\UserMailer;
use Illuminate\Http\Request;
use Cms\Http\BaseController;
use Illuminate\Auth\Passwords\TokenRepositoryInterface;

class ForgotPasswordController extends BaseController
{
    protected $mailer;
    protected $tokens;
    protected $redirectTo = '/';

    /**
     * Create a new ForgotPasswordController instance.
     *
     * @param UserMailer $mailer
     * @param TokenRepositoryInterface $tokens
     */
    public function __construct(UserMailer $mailer, TokenRepositoryInterface $tokens)
    {
        parent::__construct();

        $this->mailer = $mailer;
        $this->tokens = $tokens;
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return view('theme::auth.passwords.email');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        $user = (new User())->where($request->only('email'))->first();

        if (!$user) {
            flash()->overlay(trans('theme::messages.password_reset.forgotten'),
                trans('theme::messages.password_reset.invalid_user'), 'error'
            );

            return redirect(route('password.forget'));
        }

        $this->mailer->sendPasswordResetTo($user, $this->tokens->create($user));

        flash()->overlay(trans('theme::messages.password_reset.forgotten'),
            trans('theme::messages.password_reset.link_sent', ['email' => $request->email]), 'success'
        );

        return redirect($this->redirectTo);
    }
}
