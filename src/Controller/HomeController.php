<?php

namespace App\Controller;

use Slim\Http\Response;

/**
 * Class HomeController
 */
class HomeController extends AppController
{
    /**
     * Home index
     *
     * @return Response
     */
    public function index() : Response
    {
        $viewData = [
            'page' => 'Home',
        ];
        return $this->render('Home/home.twig', $viewData);
    }
}
