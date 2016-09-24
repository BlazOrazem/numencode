<?php

namespace Cms\Mailers;

use Numencode\Models\User;
use Illuminate\Contracts\Mail\Mailer;

class UserMailer
{
    protected $mailer;
    protected $from;
    protected $fromName;
    protected $to;
    protected $subject = 'Notification';
    protected $view;
    protected $data = [];

    /**
     * Create a new UserMailer instance.
     *
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
        $this->from = env('MAIL_FROM_ADDRESS');
        $this->fromName = env('MAIL_FROM_NAME');
    }

    /**
     * Send email verification to a user.
     *
     * @param User $user
     */
    public function sendEmailVerificationTo(User $user)
    {
        $this->subject = 'Please, verify your e-mail!';
        $this->to = $user->email;
        $this->view = 'theme::emails.verification';
        $this->data = compact('user');

        return $this->deliver();
    }

    /**
     * Send password reset link to a user.
     *
     * @param User $user
     * @param $token
     */
    public function sendPasswordResetTo(User $user, $token)
    {
        $this->subject = 'Password Reset';
        $this->to = $user->email;
        $this->view = 'theme::emails.password';
        $this->data = compact('user', 'token');

        return $this->deliver();
    }

    /**
     * Send email.
     */
    public function deliver()
    {
        $this->mailer->send($this->view, $this->data, function ($message) {
            $message->from($this->from, $this->fromName)
                ->to($this->to)
                ->subject($this->subject);
        });
    }

    public function sendEmailTestTo($email)
    {
        $this->subject = 'Testing Email';
        $this->to = $email;
        $this->view = 'theme::emails.sample';

        return $this->deliver();
    }
}
