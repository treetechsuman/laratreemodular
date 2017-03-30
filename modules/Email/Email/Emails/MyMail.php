<?php

namespace Modules\Email\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MyMail extends Mailable
{
    use Queueable, SerializesModels;
    public $message1;
    public $subject1;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message1,$subject1)
    {
        $this->message1 = $message1;    
        $this->subject1 = $subject1;    
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('suman@socialaves.com')
        ->subject($this->subject1)
        ->view('email::maillayout');
    }
}
