<?php
$language = '{language:(?:de|en)}';

// Root
$app->get('/[' . $language . ']', 'App\Controller\HomeController:index')->setName('root');

// Login
$app->get('/' . $language . '/login', 'App\Controller\AuthenticationController:index')->setName('getLogin');
$app->post('/' . $language . '/login', 'App\Controller\AuthenticationController:login')->setName('postLogin');
$app->get('/' . $language . '/logout', 'App\Controller\AuthenticationController:logout')->setName('logout');

// User list
$app->get('/' . $language . '/users', 'App\Controller\UserController:index')->setName('userList');
$app->get('/' . $language . '/users/load', 'App\Controller\UserController:loadData')->setName('loadData');
$app->put('/' . $language . '/users/role', 'App\Controller\UserController:updateRole')->setName('putUserRole');

// Language
$app->get('/language/' . $language . '', 'App\Controller\LanguageController:language')->setName("language");

// Error
$app->get('/' . $language . '/error404', 'App\Controller\ErrorController:notFoundAction')->setName("notFound");
