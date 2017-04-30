<?php

namespace App\Providers;

use App\Listeners\LogUserLoggedIn;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Event\Class' => [
            'Listener\Class',
        ],
    ];

    /**
     * Register any events for your application.
     *
     */
    public function boot()
    {
        parent::boot();

        /** @var Dispatcher $events */
        $events = app(Dispatcher::class);

        /*
        |--------------------------------------------------------------------------
        | Log in
        |--------------------------------------------------------------------------
        |
        */
        $events->listen(Login::class, LogUserLoggedIn::class);
    }
}
