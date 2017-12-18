<?php

namespace App\Controller;


use App\Mapper\EventMapper;
use App\Repository\EventRepository;
use Cake\Database\Connection;
use Interop\Container\Exception\ContainerException;
use Slim\Container;
use Slim\Http\Request;
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
     * @param Request $request
     * @param Response $response
     * @return Response Template
     */
    public function index(Request $request, Response $response): Response
    {
        $viewData = [
            'page' => 'Events',
        ];
        return $this->render($request, $response, 'Events/events.twig', $viewData);
    }

    /**
     * Load events
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function load(Request $request, Response $response) : Response
    {
        $eventRepo = new EventMapper($this->db);
        $events = $eventRepo->getEvents();
        return $response->withJson(['events' => $events]);
    }
}
