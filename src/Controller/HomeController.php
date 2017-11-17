<?php

namespace App\Controller;

use Slim\Container;

class HomeController extends AppController
{
    /**
     * HomeController constructor.
     *
     * @param Container $container Container
     */
    public function __construct(Container $container)
    {
        parent::__construct($container);
    }

    /**
     * Home index
     *
     * @return string Template
     */
    public function index() : string
    {
        $viewData = [
            'page' => 'Home',
            'text' => 'Slim template',
        ];
        return $this->render('view::Home/home.html.php', $viewData);
    }
}
