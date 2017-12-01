<?php

use App\Adapter\MailerInterface;
use App\Adapter\MailgunAdapter;
use Cake\Database\Connection;
use Cake\Database\Driver\Mysql;
use Interop\Container\Exception\ContainerException;
use League\Plates\Engine;
use Mailgun\Mailgun;
use Odan\Plates\Extension\PlatesDataExtension;
use Slim\Container;
use Slim\Views\Twig;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use SlimSession\Helper as SessionHelper;

$app = app();
$container = $app->getContainer();

/**
 * Environment container (for routes).
 *
 * @return \Slim\Http\Environment
 */
$container['environment'] = function () {
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $_SERVER['SCRIPT_NAME'] = dirname(dirname($scriptName)) . '/' . basename($scriptName);
    return new Slim\Http\Environment($_SERVER);
};

/**
 * Database connection container.
 *
 * @param Container $container
 * @return Connection
 * @throws ContainerException
 */
$container[Connection::class] = function (Container $container) {
    $config = $container->get('settings')->get('db');
    $driver = new Mysql([
        'host' => $config['host'],
        'port' => $config['port'],
        'database' => $config['database'],
        'username' => $config['username'],
        'password' => $config['password'],
        'encoding' => $config['encoding'],
        'charset' => $config['charset'],
        'collation' => $config['collation'],
        'prefix' => '',
        'flags' => [
            // Enable exceptions
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // Set default fetch mode
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_PERSISTENT => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8 COLLATE utf8_unicode_ci"
        ]
    ]);
    $db = new Connection([
        'driver' => $driver
    ]);
    $db->connect();
    return $db;
};

/**
 * Render engine container.
 *
 * @param Container $container
 * @return Engine
 * @throws ContainerException
 */
//$container[Engine::class] = function (Container $container) {
//    $path = $container->get('settings')->get('viewPath');
//    $engine = new Engine($path, null);
//    if (!is_dir(__DIR__ . '/../public/cache')) {
//        mkdir(__DIR__ . '/../public/cache');
//    }
//    $options = array(
//        'minify' => false,
//        'public_dir' => __DIR__ . '/../public/cache',
//        'cache' => new FilesystemAdapter('assets-cache', 0, __DIR__ . '/../temp/cache'),
//    );
//    $engine->loadExtension(new \Odan\Asset\PlatesAssetExtension($options));
//    $engine->loadExtension(new PlatesDataExtension());
//    $engine->addFolder('view', $path);
//    return $engine;
//};

/**
 * Twig render engine
 *
 * @param Container $container
 * @return Twig
 * @throws ContainerException
 * @throws Twig_Error_Loader
 */
$container[Twig::class] = function (Container $container) {
    $settings = $container->get('settings');
    $viewPath = $settings['twig']['path'];

    $twig = new \Slim\Views\Twig($viewPath, [
        'cache' => $settings['twig']['cache_enabled'] ? $settings['twig']['cache_path']: false
    ]);

    /* @var Twig_Loader_Filesystem $loader */
    $loader = $twig->getLoader();
    $loader->addPath($settings['public'], 'public');

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container->get('request')->getUri()->getBasePath()), '/');
    $twig->addExtension(new Slim\Views\TwigExtension($container->get('router'), $basePath));

    // Add the Assets extension to Twig
    $twig->addExtension(new \Odan\Twig\TwigAssetsExtension($twig->getEnvironment(), $settings['twig']['assets']));

    return $twig;
};

/**
 * Session container
 *
 * @return SessionHelper
 */
$container[SessionHelper::class] = function () {
    return new SessionHelper();
};

/**
 * Mailer container
 *
 * @param Container $container
 * @return MailerInterface
 * @throws ContainerException
 */
$container[MailerInterface::class] = function (Container $container) {
    $mailgunSettings = $container->get('settings')->get('mailgun');
    $mailgun = Mailgun::create($mailgunSettings['api-key']);
    $mailgunAdapter = new MailgunAdapter($mailgunSettings['domain'], $mailgun, $mailgunSettings['from']);
    return $mailgunAdapter;
};
