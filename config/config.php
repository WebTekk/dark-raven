<?php

$defaults = require __DIR__ . '/defaults.php';

$env = [];

if (defined('APP_ENV')) {
    $config = require __DIR__ . '/' . APP_ENV . '.php';
    $defaults = array_replace_recursive($defaults, $config);
}

if (file_exists(__DIR__ . '/../../env.php')) {
    $env = require __DIR__ . '/../../env.php';
} elseif (file_exists(__DIR__ . '/env.php')) {
    $env = require __DIR__ . '/env.php';
} else {
    $env = [];
}

$config = array_replace_recursive($defaults, $env);

return $config;
