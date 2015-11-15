<?php

namespace App\Listeners;

use App\Models\User;
use App\Utils\AppMailer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserEventListener
{
    /**
     * App Mailer
     *
     * @var Mailer
     */
    private $mailer;

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
     * Event on user login.
     *
     * @param User $user
     */
    public function onUserLogin(User $user)
    {
        flash()->success("Welcome " . $user->name . "!", "You have successfully logged in.");
    }

    /**
     * Event on user logout.
     */
    public function onUserLogout()
    {
        flash()->success("Logged out", "You have successfully logged out.\\nWe hope to see you again soon.");
    }

    /**
     * Event on user's password reset request.
     *
     * @param User $user
     * @param $token
     */
    public function onPasswordReset(User $user, $token)
    {
        $this->mailer->sendPasswordResetTo($user, $token);
    }

}
