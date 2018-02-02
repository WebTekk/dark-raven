<?php
$language = '{language:(?:de|en)}';

$app->get('/[' . $language . ']', 'App\Controller\HomeController:index')->setName('root');

$app->get('/' . $language . '/login', 'App\Controller\AuthenticationController:index')->setName('getLogin');
$app->post('/' . $language . '/login', 'App\Controller\AuthenticationController:login')->setName('postLogin');
$app->get('/' . $language . '/logout', 'App\Controller\AuthenticationController:logout')->setName('logout');

$app->get('/language/' . $language . '', 'App\Controller\LanguageController:language')->setName("language");

$app->get('/' . $language . '/error404', 'App\Controller\ErrorController:notFoundAction')->setName("notFound");
