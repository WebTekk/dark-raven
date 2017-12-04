<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app = app();
$container = $app->getContainer();

$app->add(function (Request $request, Response $response, $next) {
    if (empty($request->getAttribute('language'))) {
        $language = $request->getHeader('accept-language')[0];
        $language = explode(',', $language)[0];
        $language = explode('-', $language)[0];
        return $response->withRedirect($this->router->pathFor('root', ['language' => $language]));
    }
    return $next($request, $response);
});

$app->add(function (Request $request, Response $response, $next) {
    $route = $request->getAttribute('route');
    if (empty($route)) {
        return $next($request, $response);
    }
    $language = $route->getArgument('language');
    $request = $request->withAttribute('language', $language);

    $response = $next($request, $response);

    return $response;
});
