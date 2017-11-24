<?php

namespace App\Adapter;

use Mailgun\Mailgun;

class MailgunAdapter
{
    /**
     * @var Mailgun
     */
    protected $mailgun;

    /**
     * @var string
     */
    protected $domain;

    public function __construct($domain, Mailgun $mailgun)
    {
        $this->mailgun = $mailgun;
        $this->domain = $domain;
    }

    public function sendMail($from, $to, $subject, $text)
    {
        # First, instantiate the SDK with your API credentials
        $mg = $this->mailgun;

        # Now, compose and send your message.
        # $mg->messages()->send($domain, $params);
        $mg->messages()->send($this->domain, [
            'from' => $from,
            'to' => $to,
            'subject' => $subject,
            'text' => $text,
        ]);
    }
}
