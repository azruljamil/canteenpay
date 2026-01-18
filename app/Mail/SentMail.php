<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $detail;

    public function __construct($detail)
    {
        $this->detail = $detail;
    }

    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
                    ->subject('CD Jelajah 5G SME WORKSHOP Attendee Registration')
                    ->view('email.thank_you')
                    ->with('detail', $this->detail);
    }
}
