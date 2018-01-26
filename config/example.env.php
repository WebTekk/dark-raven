<?php

$env = [];

// Secret configurations
$env['db']['host'] = "localhost";
$env['db']['username'] = "username";
$env['db']['password'] = "password";

$env['twig']['debug'] = true;
$env['twig']['autoReload'] = true;
$env['twig']['assetCache']['cache_enabled'] = false;

return $env;
