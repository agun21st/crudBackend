<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $emailVerifyCode;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailVerifyCode)
    {
        $this->emailVerifyCode = $emailVerifyCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Email Verification Code From Forex Stick')->view('emails.emailVerificationMail');
    }
}
