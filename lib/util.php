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
        //$config = require_once __DIR__ . '/../config/config.php';
        //$app = new App($config);
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
