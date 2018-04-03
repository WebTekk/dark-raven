<?php

namespace App\Controller;

use App\Service\Authentication\AuthenticationService;
use App\Service\Registration\RegistrationService;
use App\Table\UserTable;
use Aura\Session\Session;
use Cake\Database\Connection;
use Interop\Container\Exception\ContainerException;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class RegisterController extends AppController
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
            'page' => 'Register',
        ];

        return $this->render($request, $response, 'Register/register.twig', $viewData);
    }

    public function register(Request $request, Response $response): Response
    {
        $registrationService = new RegistrationService($this->db);
        $userTable = new UserTable($this->db);
        $data = $request->getParsedBody();
        $validation = $registrationService->validateUser($data['user']);
        if (!$validation->isValid()) {
            $viewData = [
                'errors' => $validation->getErrors(),
                'success' => false,
            ];

            return $response->withJson(json_encode($viewData));
        }
        $userTable->addUser($data['user']);
        $authenticationService = new AuthenticationService($this->db, $this->session);
        $authenticationService->loginUser($data['user']['username']);

        return $response->withJson(json_encode(['success' => true]));
    }
}
