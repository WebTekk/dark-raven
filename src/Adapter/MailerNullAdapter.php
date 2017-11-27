<?php

namespace App\Adapter;


class MailerNullAdapter implements MailerInterface
{
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
        return true;
    }
}
