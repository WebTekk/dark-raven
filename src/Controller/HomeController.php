<?php

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class HomeController
 */
class HomeController extends AppController
{
    /**
     * Home index
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function index(Request $request, Response $response) : Response
    {
        $viewData = [
            'page' => 'Home',
        ];
        return $this->render($request, $response, 'Home/home.twig', $viewData);
    }
}
