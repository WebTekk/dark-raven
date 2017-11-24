<?php
$app = app();

$app->get('/', route(['App\Controller\HomeController', 'index']))->setName("root");
$app->get('/events', route(['App\Controller\EventController', 'index']))->setName("events");
$app->get('/events/load', route(['App\Controller\EventController', 'load']))->setName("loadEvents");

$app->get('/mail', route(['App\Controller\MailingController', 'mail']))->setName("mailer");
