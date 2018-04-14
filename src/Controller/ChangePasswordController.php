<?php

namespace App\Controller;


use App\Service\ChangePassword\ChangePasswordService;
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

    /**
     * Change password page
     *
     * @param Request $request Request
     * @param Response $response Response
     * @return Response
     */
    public function index(Request $request, Response $response)
    {
        $viewData = [
            'page' => 'ChangePassword',
        ];

        return $this->render($request, $response, 'ChangePassword/change-password.twig', $viewData);
    }

    public function changePassword(Request $request, Response $response)
    {
        $changeService = new ChangePasswordService($this->db, $this->session);
        $data = $request->getParsedBody();
        if (!$changeService->changePassword($data['passwordOld'], $data['passwordNew'], $data['passwordRepeat'])) {
            $viewData = ['success' => false];
        } else {
            $viewData = ['success' => true];
        }
        return $response->withJson(json_encode($viewData));
    }
}
