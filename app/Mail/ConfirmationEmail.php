<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmationEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $verifyEmail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($verifyEmail)
    {
        $this->verifyEmail = $verifyEmail;        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Verifikasi Email '. $this->verifyEmail["verify_roles"])
            ->view('emails.emailVerificationEmail');
    }
}
