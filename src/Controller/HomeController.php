<?php

namespace App\Controller;

/**
 * Class HomeController
 */
class HomeController extends AppController
{
    /**
     * Home index
     *
     * @return string Template
     */
    public function index() : string
    {
        $viewData = [
            'page' => 'Home',
        ];
        return $this->render('view::Home/home.html.php', $viewData);
    }
}
