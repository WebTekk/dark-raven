<?php

// Error reporting
error_reporting(0);
ini_set('display_errors', '0');
// Timezone
date_default_timezone_set('Europe/Berlin');

$config = [];

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$config['db']['database'] = "slim";
$config['db']['port'] = '3306';
$config['db']['charset'] = 'utf8';
$config['db']['encoding'] = 'utf8';
$config['db']['collation'] = 'utf8_unicode_ci';

$config['canonical'] = 'https://www.tekk.ch';

$config['viewPath'] = __DIR__ . '/../templates';

if (file_exists(__DIR__ . '/../../env.php')) {
    $env = require_once(__DIR__ . '/../../env.php');
} elseif (file_exists(__DIR__ . '/env.php')) {
    $env = require_once(__DIR__ . '/env.php');
} else {
    $env = [];
}

$config = array_merge_recursive($config, $env);

return $config;
