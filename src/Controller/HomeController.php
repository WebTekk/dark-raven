<?php

namespace App\Controller;

use Slim\Container;

class HomeController extends AppController
{
    public function __construct(Container $container)
    {
        parent::__construct($container);
    }

    public function index()
    {
        $viewData = [
            'page' => 'Home',
            'text' => 'Slim template',
        ];
        return $this->render('view::Home/home.html.php', $viewData);
    }
}
