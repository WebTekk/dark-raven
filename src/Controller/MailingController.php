<?php
/**
 * Created by PhpStorm.
 * User: marc.wilhelm
 * Date: 24.11.2017
 * Time: 10:11
 */

namespace App\Controller;

use Mailgun\Mailgun;

class MailingController extends AppController
{
    public function mail()
    {
        # First, instantiate the SDK with your API credentials
        $mg = Mailgun::create('key-94a19c440c1a85b632a84e4bbfa77632');

        # Now, compose and send your message.
        # $mg->messages()->send($domain, $params);
        $mg->messages()->send('sandboxe34fb02684c8483180a650a5ee42cd6c.mailgun.org', [
            'from' => 'tekk@tekk.ch',
            'to' => 'tekk@tekk.ch',
            'subject' => 'The PHP SDK is awesome!',
            'text' => 'It is so simple to send a message.'
        ]);
    }
}
