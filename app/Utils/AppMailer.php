<?php

namespace App\Utils;

use App\Models\User;
use Illuminate\Contracts\Mail\Mailer;

class AppMailer {

    protected $mailer;
    protected $from;
    protected $fromName;
    protected $to;
    protected $subject = 'Notification';
    protected $view;
    protected $data = [];

    /**
     * Create a new AppMailer instance.
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
     * Send email verification to given user.
     *
     * @param User $user
     */
    public function sendEmailVerificationTo(User $user)
    {
        $this->subject = 'Please, verify your e-mail!';
        $this->to = $user->email;
        $this->view = 'emails.verification';
        $this->data = compact('user');

        return $this->deliver();
    }

    /**
     * Send email.
     */
    public function deliver()
    {
        $this->mailer->send($this->view, $this->data, function($message) {
            $message->from($this->from, $this->fromName)
                ->to($this->to)
                ->subject($this->subject);
        });
    }

}
