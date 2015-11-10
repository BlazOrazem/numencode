<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserEventListener
{

    /**
     * User login event.
     */
    public function onUserLogin()
    {
//        flash()->success("Welcome " . Auth::user()->name . "!", "You have successfully logged in.");
    }

    /**
     * User logout event.
     */
    public function onUserLogout()
    {
        flash()->success("Logged out", "You have successfully logged out.\\nWe hope to see you again soon.");
    }

}
