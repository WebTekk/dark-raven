<?php

use Slim\App;
use Symfony\Component\Translation\Translator;

/**
 * Get app.
 *
 * @return App
 */
function app(): App
{
    static $app = null;
    if ($app === null) {
        $app = new App(['settings' => require __DIR__ . '/../config/config.php']);
    }
    return $app;
}

/**
 * Handling email
 *
 * This function is shortening for filter_var.
 *
 * @see filter_var()
 *
 * @param string $email to check
 *
 * @return mixed
 */
function is_email(string $email): mixed
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Make routes callable
 *
 * @param callable $route Route
 * @return string Imploded route
 */
function route(callable $route): string
{
    return implode(':', (array)$route);
}

/**
 * Text translation (I18n)
 *
 * @param string $message
 * @return string
 * @throws \Psr\Container\ContainerExceptionInterface
 * @throws \Psr\Container\NotFoundExceptionInterface
 */
function __($message)
{
    /* @var $translator Translator */
    $translator = app()->getContainer()->get(Translator::class);
    $translated = $translator->trans($message);
    $context = array_slice(func_get_args(), 1);
    if (!empty($context)) {
        $translated = vsprintf($translated, $context);
    }
    return $translated;
}
