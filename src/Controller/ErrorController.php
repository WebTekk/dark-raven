<?php

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

class ErrorController extends AppController
{
    /**
     * Not found action.
     *
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function notFoundAction(Request $request, Response $response): Response
    {
        $response = $response->withStatus(404);

        return $this->render($request, $response, 'Error/404.twig', []);
    }
}
