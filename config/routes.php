<?php
$app = app();

$app->get('/', 'App\Controller\HomeController:index')->setName("root");

