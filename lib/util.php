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
        $config = require_once __DIR__ . '/../config/config.php';
        $app = new App($config);
    }
    return $app;
}
