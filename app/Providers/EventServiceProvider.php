<?php

namespace Numencode\Providers;

use Event;
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
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Event::listen(
            'user.reset_password',
            'Numencode\Listeners\UserEventListener@onPasswordReset'
        );

        Event::listen(
            'user.update_profile',
            'Numencode\Listeners\UserEventListener@onProfileUpdate'
        );
    }
}
