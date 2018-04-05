<?php

namespace App\Controller;

use App\Service\Authentication\AuthenticationService;
use Aura\Session\Session;
use Cake\Database\Connection;
use Interop\Container\Exception\ContainerException;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * AuthenticationController.
 */
class AuthenticationController extends AppController
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

    /**
     * Layout page index.
     *
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function index(Request $request, Response $response): Response
    {
        $viewData = [
            'page' => 'Login',
        ];

        return $this->render($request, $response, 'Login/login.twig', $viewData);
    }

    /**
     * Layout.
     *
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function login(Request $request, Response $response): Response
    {
        $authenticationService = new AuthenticationService($this->db, $this->session);
        $data = $request->getParsedBody();
        $validation = $authenticationService->validateLogin($data['username'], $data['password']);
        if (!$validation->isValid()) {
            $viewData = [
                'page' => 'Login',
                'success' => false,
                'errors' => $validation->getErrors(),
            ];

            return $response->withJson(json_encode($viewData));
        }
        $authenticationService->loginUser($data['username']);
        $viewData = [
            'page' => 'Login',
            'success' => true,
        ];

        return $response->withJson(json_encode($viewData));
    }

    /**
     * Log out user.
     *
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function logout(Request $request, Response $response): Response
    {
        $this->session->destroy();

        return $response->withJson(json_encode(['logout' => true]));
    }
}
