<?php

namespace App\Controller;

use App\Service\User\UserService;
use App\Table\UserTable;
use Cake\Database\Connection;
use Interop\Container\Exception\ContainerException;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class HomeController.
 */
class UserController extends AppController
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
            'page' => 'Users',
        ];

        return $this->render($request, $response, 'User/userList.twig', $viewData);
    }

    /**
     * Load all users.
     *
     * @param Request $request Request
     * @param Response $response Response
     *
     * @return Response
     */
    public function loadAllUsers(Request $request, Response $response): Response
    {
        $userService = new UserService($this->db);
        $users = $userService->loadAllUsers();
        $usersArray = [];
        foreach ($users as $user) {
            $usersArray[] = $user->toArray();
        }
        $viewData = [
            'users' => $usersArray,
        ];

        return $response->withJson(json_encode($viewData));
    }

    /**
     * Edit user role.
     *
     * @param Request $request Request
     * @param Response $response Response
     *
     * @return Response Response
     */
    public function updateRole(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        if (empty($data['id']) || empty($data['role'])) {
            return $response->withJson(json_encode(['success' => false]));
        }

        $userTable = new UserTable($this->db);
        $userTable->updateRole($data['id'], $data['role']);

        return $response->withJson(json_encode(['success' => true]));
    }
}
