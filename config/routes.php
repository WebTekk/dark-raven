<?php
$app = app();

$app->get('/[{language}]', route(['App\Controller\HomeController', 'index']))->setName('root');

$app->get('/{language}/events', route(['App\Controller\EventController', 'index']))->setName("events");
$app->get('/{language}/events/load', route(['App\Controller\EventController', 'load']))->setName("loadEvents");
$app->get('/{language}/mail', route(['App\Controller\MailingController', 'mail']))->setName("mailer");

$app->get('/language/{language}', route(['App\Controller\LanguageController', 'language']))->setName("language");
