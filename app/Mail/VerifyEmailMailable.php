<?php


// app/Mail/VerifyEmailMailable.php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmailMailable extends Mailable
{
    use SerializesModels;

    public $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function build()
    {
        return $this->markdown('emails.verify-email')
            ->with([
                'url' => $this->url,
            ]);
    }
}
