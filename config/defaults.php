<?php

use App\Adapter\MailerInterface;
use Aura\Session\Session;
use Symfony\Component\Translation\Translator;

$config = [];

$applicationName = 'slim';

$config = [
    'displayErrorDetails' => false,
    'determineRouteBeforeAppMiddleware' => true,
//'addContentLengthHeader' => false,
];

$config[Session::class] = [
    'name' => $applicationName,
    'cache_expire' => 14400,
];

$config[Translator::class] = [
    'locale' => 'de_CH',
    'path' => __DIR__ . '/../resources/locale',
];

$config['migrations'] = __DIR__ . '/../resources/migrations';

$config['db'] = [
    'database' => 'slim',
    'charset' => 'utf8',
    'encoding' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'port' => 3306,
];

$config['db_test'] = [
    'database' => 'slim_test',
    'charset' => 'utf8',
    'encoding' => 'utf8',
    'collation' => 'utf8_unicode_ci',
];

$config['twig'] = [
    'viewPath' => __DIR__ . '/../templates',
    'cachePath' => __DIR__ . '/../tmp/cache/twig',
    'autoReload' => false,
    'assetCache' => [
        'path' => __DIR__ . '/../public/assets',
        // Cache settings
        'cache_enabled' => true,
        'cache_path' => __DIR__ . '/../tmp/cache',
        'cache_name' => 'assets',
        'cache_lifetime' => 0,
    ],
];

$config['session'] = [
    'name' => 'slim',
    'autorefresh' => true,
    'lifetime' => '2 hours',
    'path' => '/', //default
    'domain' => null, //default
    'secure' => false, //default
    'httponly' => false, //default
];

$config['logger'] = [
    'main' => 'app',
    'context' => [
        MailerInterface::class => 'mail',
    ],
];

$config['mailgun'] = [
    'from' => '',
    'apikey' => '',
    'domain' => '',
];

return $config;
