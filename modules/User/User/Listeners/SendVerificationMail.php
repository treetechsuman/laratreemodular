<?php

namespace Modules\User\Listeners;

use Modules\User\Events\UserCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use Modules\User\Emails\VerificationMail;
use Modules\User\Repositories\UserTrait;

class SendVerificationMail
{
    use UserTrait;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $activation_code = SendVerificationMail::generateVerificationCode($event->user['id']);
        Mail::to('me.suman11@gmail.com')
        ->send(new VerificationMail($event->user,$activation_code));
        dd($event->user);
    }
}
