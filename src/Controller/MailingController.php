<?php
/**
 * Created by PhpStorm.
 * User: marc.wilhelm
 * Date: 24.11.2017
 * Time: 10:11
 */

namespace App\Controller;

use App\Adapter\MailerInterface;
use Slim\Container;

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
    public function mail()
    {
        $mailgunAdapter = $this->mailer;
        $mailgunAdapter->sendMail('tekk@tekk.ch', 'Mailgun Subject', 'Mailgun text!');
    }
}
