<?php

$defaults = require __DIR__ . '/defaults.php';

$env = [];

if (file_exists(__DIR__ . '/../../env.php')) {
    $env = require __DIR__ . '/../../env.php';
} elseif (file_exists(__DIR__ . '/env.php')) {
    $env = require __DIR__ . '/env.php';
} else {
    $env = [];
}
$defaults = array_replace_recursive($defaults, $env);

if (defined('APP_ENV')) {
    $config = require __DIR__ . '/' . APP_ENV . '.php';
    $defaults = array_replace_recursive($defaults, $config);
}

return $defaults;
