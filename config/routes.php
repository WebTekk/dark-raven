<?php
$app = app();

$app->get('/', 'App\Controller\HomeController:index')->setName("root");
$app->get('/events', 'App\Controller\EventController:index')->setName("events");
$app->get('/events/load', 'App\Controller\EventController:load')->setName("loadEvents");

