<?php

namespace App\Controller;


use Aura\Session\Session;
use Cake\Database\Connection;
use Interop\Container\Exception\ContainerException;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class ChangePasswordController extends AppController
{
    /**
     * @var Connection
     */
    protected $db;

    /**
     * @var Session
     */
    protected $session;

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
        $this->session = $container->get(Session::class);
    }

    public function index(Request $request, Response $response)
    {
        $viewData = [
            'page' => 'ChangePassword',
        ];

        return $this->render($request, $response, 'ChangePassword/change-password.twig', $viewData);
    }
}