<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        $events->listen(
            'user.logged_in', 'App\Listeners\UserEventListener@onUserLogin'
        );

        $events->listen(
            'auth.logout', 'App\Listeners\UserEventListener@onUserLogout'
        );

        $events->listen(
            'user.reset_password', 'App\Listeners\UserEventListener@onPasswordReset'
        );
    }
}
