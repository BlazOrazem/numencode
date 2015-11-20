<?php

namespace Numencode\Listeners;

use Numencode\Models\User;
use Numencode\Utils\AppMailer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserEventListener
{
    /**
     * The app mailer implementation.
     *
     * @var AppMailer
     */
    protected $mailer;

    /**
     * Create a new user event listener instance.
     *
     * @param AppMailer $mailer
     */
    public function __construct(AppMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Send password reset link to given user.
     *
     * @param User $user
     * @param $token
     */
    public function onPasswordReset(User $user, $token)
    {
        $this->mailer->sendPasswordResetTo($user, $token);
    }

    /**
     * Send email verification link if given user is not verified.
     *
     * @param User $user
     */
    public function onProfileUpdate(User $user)
    {
        if ($user->is_verified) return;

        $this->mailer->sendEmailVerificationTo($user);
    }
}
