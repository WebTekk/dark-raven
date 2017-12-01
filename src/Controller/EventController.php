<?php

namespace App\Controller;


use App\Repository\EventRepository;
use Cake\Database\Connection;
use Interop\Container\Exception\ContainerException;
use Slim\Container;
use Slim\Http\Response;

/**
 * Class EventController
 */
class EventController extends AppController
{
    /**
     * @var Connection
     */
    protected $db;

    /**
     * EventController constructor.
     * @param Container $container Container
     * @throws ContainerException
     */
    public function __construct(Container $container)
    {
        parent::__construct($container);
        $this->db = $container->get(Connection::class);
    }

    /**
     * Home index
     *
     * @return Response Template
     */
    public function index(): Response
    {
        $viewData = [
            'page' => 'Events',
        ];
        return $this->render('Events/events.twig', $viewData);
    }

    /**
     * Load events
     *
     * @return Response
     */
    public function load() : Response
    {
        $eventRepo = new EventRepository($this->db);
        $events = $eventRepo->getEvents();
        return $this->response->withJson(['events' => $events]);
    }
}
