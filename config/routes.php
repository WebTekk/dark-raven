<?php
$language = '{language:(?:de|en)}';

$app->get('/[' . $language . ']', 'App\Controller\HomeController:index')->setName('root');

$app->get('/' . $language . '/events', 'App\Controller\EventController:index')->setName("events");
$app->get('/' . $language . '/events/load', 'App\Controller\EventController:load')->setName("loadEvents");

$app->get('/language/' . $language . '', 'App\Controller\LanguageController:language')->setName("language");

$app->get('/' . $language . '/xml', 'App\Controller\ZInvoiceController:index')->setName("xml");

$app->get('/' . $language . '/error404', 'App\Controller\ErrorController:notFoundAction')->setName("notFound");
