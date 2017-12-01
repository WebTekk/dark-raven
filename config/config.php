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

$config['twig'] = [
    // Public assets cache directory
    'path' => __DIR__ . '/../templates',
    'cache' => __DIR__ . '/../temp/cache/twig',
    'cache_enabled' => true,
    'minify' => 1,
    'debug' => true,
    'assets' => [
        'path' => __DIR__ . '/../public/cache',
        // Cache settings
        'cache_enabled' => true,
        'cache_path' => __DIR__ . '/../temp/cache',
        'cache_name' => 'assets',
        'cache_lifetime' => 0,
    ]
];

$config['session'] = [
    'name' => 'slim_template',
    'autorefresh' => true,
    'lifetime' => '2 hours',
    'path' => '/', //default
    'domain' => null, //default
    'secure' => false, //default
    'httponly' => false, //default
];

$config['mailgun'] = [
    'from' => '',
    'domain' => '',
    'api-key' => '',
];

if (file_exists(__DIR__ . '/../../env.php')) {
    $env = require_once(__DIR__ . '/../../env.php');
} elseif (file_exists(__DIR__ . '/env.php')) {
    $env = require_once(__DIR__ . '/env.php');
} else {
    $env = [];
}

$config = array_replace_recursive($config, $env);

return $config;
