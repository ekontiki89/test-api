<?php

namespace App\Providers;

use App\Entities\Account;
use App\Entities\User;
use App\Observers\UuidObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        $this->registerUuidObservers();

        //
    }

    /**
     * Register Uuid Observers
     */
    public function registerUuidObservers()
    {
        User::observe(app(UuidObserver::class));
        Account::observe(app(UuidObserver::class));
    }
}
