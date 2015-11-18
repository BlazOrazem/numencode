<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Messages Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in classes across app for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'success' => 'Success',
    'error'   => 'Error',

    'login' => [
        'title'   => 'Welcome :name!',
        'content' => 'You have successfully logged in.',
    ],
    'logout' => [
        'title'   => 'Logged out',
        'content' => "You have successfully logged out.\\nWe hope to see you again soon.",
    ],
    'email_verified' => [
        'title'   => 'Email verified',
        'success' => 'You successfully verified your email address :email.',
        'error'   => 'This email address has already been verified.',
    ],
    'password_reset' => [
        'title'     => 'Password reset',
        'success'   => 'Your password was successfully changed.',
        'forgotten' => 'Forgotten password',
        'link_sent' => "Password reset link was sent to your email address :email.\\nPlease check your inbox.",
    ],
    'user_profile' => [
        'title'             => 'Profile updated',
        'success'           => 'This email address has already been verified.',
        'profile_success'   => 'Your profile was successfully updated.',
        'password_success'  => 'Your password was successfully updated.',
        'verification_sent' => "Email verification link has been sent to your email address :email.\\nPlease check your inbox and click on the link.",
    ],

];
