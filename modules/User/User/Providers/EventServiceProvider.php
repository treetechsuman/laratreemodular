<?php

namespace Modules\User\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mModules\Userings for the Modules\Userlication.
     *
     * @var array
     */
    protected $listen = [
        'Modules\User\Events\UserCreated' => [
            'Modules\User\Listeners\SendVerificationMail',
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

        //
    }
}
