<?php

namespace Modules\User\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\User\Entities\User;

class VerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $myuser;
    public $activation_code;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $myuser,$activation_code)
    {
        $this->myuser = $myuser;
        $this->activation_code=$activation_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('me.suman11@gmail.com')
                    ->view('user::email.welcome');
    }
}
