<?php

namespace App\Controller;


use App\Repository\EventRepository;
use Cake\Database\Connection;
use Slim\Container;
use Slim\Http\Response;

class EventController extends AppController
{
    /**
     * @var Connection
     */
    protected $db;

    /**
     * EventController constructor.
     * @param Container $container Container
     */
    public function __construct(Container $container)
    {
        parent::__construct($container);
        $this->db = $container->get(Connection::class);
    }

    /**
     * Home index
     *
     * @return string Template
     */
    public function index(): string
    {
        $viewData = [
            'page' => 'Events',
        ];
        return $this->render('view::Events/events.html.php', $viewData);
    }

    /**
     * Load events
     *
     * @return Response
     */
    public function load()
    {
        $eventRepo = new EventRepository($this->db);
        $events = $eventRepo->getEvents();
        return $this->response->withJson(['events' => $events]);
    }
}
