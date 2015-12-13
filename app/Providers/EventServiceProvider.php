<?php

namespace Numencode\Providers;

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
            'user.reset_password',
            'Numencode\Listeners\UserEventListener@onPasswordReset'
        );

        $events->listen(
            'user.update_profile',
            'Numencode\Listeners\UserEventListener@onProfileUpdate'
        );
    }
}
