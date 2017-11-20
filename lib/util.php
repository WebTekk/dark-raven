<?php

use Slim\App;

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
function is_email($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Make routes callable
 *
 * @param callable $route Route
 * @return string Imploded route
 */
function route(callable $route)
{
    return implode(':', (array)$route);
}
