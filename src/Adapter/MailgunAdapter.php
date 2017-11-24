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

    /**
     * MailgunAdapter constructor.
     *
     * @param string $domain Domain
     * @param Mailgun $mailgun Mailgun
     */
    public function __construct($domain, Mailgun $mailgun)
    {
        $this->mailgun = $mailgun;
        $this->domain = $domain;
    }

    /**
     * Send mail
     *
     * @param string $from Sender
     * @param string $to Receiver
     * @param string $subject Mail subject
     * @param string $text Mail text
     * @return void
     */
    public function sendMail($from, $to, $subject, $text)
    {
        $this->mailgun->messages()->send($this->domain, [
            'from' => $from,
            'to' => $to,
            'subject' => $subject,
            'text' => $text,
        ]);
    }
}
