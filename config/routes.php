<?php
$language = '{language:(?:de|en)}';

$app->get('/[' . $language . ']', 'App\Controller\HomeController:index')->setName('root');

$app->get('/language/' . $language . '', 'App\Controller\LanguageController:language')->setName("language");

$app->get('/' . $language . '/error404', 'App\Controller\ErrorController:notFoundAction')->setName("notFound");
