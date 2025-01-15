<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    public $token;
    public $email;

    /**
     * Create a new message instance.
     */
    public function __construct($token,$email)
    {
        $this->token=$token;
        $this->email=$email;
    }

    public function build(){
        return $this->view('emails.reset_password')
        ->with([
            'token'=>$this->token,
            'email'=>$this->email
        ]);
    }
}
