<?php

namespace App\Controller;

use Cake\Database\Connection;
use Interop\Container\Exception\ContainerException;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class TodoController.
 */
class TodoController extends AppController
{
    /**
     * @var Connection
     */
    protected $db;

    /**
     * EventController constructor.
     *
     * @param Container $container Container
     *
     * @throws ContainerException
     */
    public function __construct(Container $container)
    {
        parent::__construct($container);
        $this->db = $container->get(Connection::class);
    }

    /**
     * User index.
     *
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function index(Request $request, Response $response): Response
    {
        $viewData = [
            'page' => 'Todo',
        ];

        return $this->render($request, $response, 'Todo/todo.twig', $viewData);
    }
}
