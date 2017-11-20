<?php
/**
 * Created by PhpStorm.
 * User: marc.wilhelm
 * Date: 20.11.2017
 * Time: 09:35
 */

namespace App\Controller;


class EventController extends AppController
{
    /**
     * Home index
     *
     * @return string Template
     */
    public function index() : string
    {
        $viewData = [
            'page' => 'Events',
        ];
        return $this->render('view::Events/events.html.php', $viewData);
    }
}
