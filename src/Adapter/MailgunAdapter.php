<?php

namespace App\Adapter;

use Mailgun\Mailgun;

class MailgunAdapter implements MailerInterface
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
     * @var string
     */
    protected $from;

    /**
     * MailgunAdapter constructor.
     *
     * @param string $domain Domain
     * @param Mailgun $mailgun Mailgun
     */
    public function __construct(string $domain, Mailgun $mailgun, string $from)
    {
        $this->mailgun = $mailgun;
        $this->domain = $domain;
        $this->from = $from;
    }

    /**
     * Send mail
     *
     * @param string $from Sender
     * @param string $to Receiver
     * @param string $subject Mail subject
     * @param string $text Mail text
     * @return bool
     */
    public function sendMail(string $to, string $subject, string $text, ?string $from = null): bool
    {
        if (empty($from)) {
            $from = $this->from;
        }

        $this->mailgun->messages()->send($this->domain, [
            'from' => $from,
            'to' => $to,
            'subject' => $subject,
            'text' => $text,
        ]);
        return true;
    }
}
