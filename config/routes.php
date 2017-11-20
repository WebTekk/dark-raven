<?php
$app = app();

$app->get('/', 'App\Controller\HomeController:index')->setName("root");
$app->get('/events', 'App\Controller\EventController:index')->setName("events");

