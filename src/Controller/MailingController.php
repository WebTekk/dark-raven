<?php
/**
 * Created by PhpStorm.
 * User: marc.wilhelm
 * Date: 24.11.2017
 * Time: 10:11
 */

namespace App\Controller;

use App\Adapter\MailgunAdapter;
use Mailgun\Mailgun;
use Slim\Container;

class MailingController extends AppController
{
    /**
     * @var array
     */
    protected $mailgunSettings;

    /**
     * @var Mailgun
     */
    protected $mailgun;

    /**
     * EventController constructor.
     * @param Container $container Container
     */
    public function __construct(Container $container)
    {
        parent::__construct($container);
        $this->mailgunSettings = $container->get('settings')->get('mailgun');
        $this->mailgun = $container->get(Mailgun::class);
    }

    /**
     * Mailer index
     *
     * @return void
     */
    public function mail()
    {
        $mailgunAdapter = new MailgunAdapter($this->mailgunSettings['domain'], $this->mailgun);
        $mailgunAdapter->sendMail($this->mailgunSettings['from'], 'tekk@tekk.ch', 'Mailgun Subject', 'Mailgun text!');
    }
}
