<?php

namespace App\Controller;

use App\Adapter\MailerInterface;
use Slim\Container;

/**
 * Class MailingController
 */
class MailingController extends AppController
{
    /**
     * @var MailerInterface
     */
    protected $mailer;

    /**
     * EventController constructor.
     * @param Container $container Container
     */
    public function __construct(Container $container)
    {
        parent::__construct($container);
        $this->mailer = $container->get(MailerInterface::class);
    }

    /**
     * Mailer index
     *
     * @return void
     */
    public function mail(): void
    {
        $mailgunAdapter = $this->mailer;
        $mailgunAdapter->sendMail('tekk@tekk.ch', 'Mailgun Subject', 'Mailgun text!');
    }
}
