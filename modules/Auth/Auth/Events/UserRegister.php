<?php

namespace Modules\Auth\Events;

use Illuminate\Queue\SerializesModels;

class UserRegister
{
    use SerializesModels;


    /**
     * Create a new event instance.
     *
     * @param  Order  $user
     * @return void
     */
    public function __construct()
    {
        
    }
}