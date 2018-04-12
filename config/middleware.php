<?php

use Aura\Session\Session;
use Slim\Exception\NotFoundException;
use Slim\Http\Request;
use Slim\Http\Response;
use Symfony\Component\Translation\Translator;

$container = $app->getContainer();

$app->add(function (Request $request, Response $response, $next) use ($container) {
    $route = $request->getAttribute('route');
    $session = $container->get(Session::class);
    $locale = $request->getAttribute('language');
    $routeName = $route->getName();
    $publicRoutes = [
        'root',
        'getLogin',
        'postLogin',
        'language',
        'notFound',
        'getRegister',
        'postRegister',
        'logout',
    ];
    $authorizationRoutes = [
        'getRegister',
        'postRegister',
        'getLogin',
        'postLogin',
        'todo',
    ];
    $segment = $session->getSegment('session');
    $role = $segment->get('role');
    if ($role && in_array($routeName, $authorizationRoutes)) {
        return $response->withRedirect($this->router->pathFor('notFound', ['language' => $locale]));
    }
    if ($role !== 'ROLE_ADMIN' && !in_array($routeName, $publicRoutes)) {
        return $response->withRedirect($this->router->pathFor('notFound', ['language' => $locale]));
    }

    return $next($request, $response);
});

$app->add(function (Request $request, Response $response, $next) use ($container) {
    $locale = $request->getAttribute('language');
    if ($locale == 'de') {
        $locale = 'de_DE';
    }

    $translator = $container->get(Translator::class);

    $resource = __DIR__ . "/../resources/locale/" . $locale . "_messages.mo";

    $translator->setLocale($locale);
    $translator->setFallbackLocales(['en_US']);
    $translator->addResource('mo', $resource, $locale);

    return $next($request, $response);
});

$app->add(function (Request $request, Response $response, $next) {

    $language = $request->getAttribute('language');
    $hasLanguage = !empty($language);

    if (empty($language)) {
        // Browser language
        $language = $request->getHeader('accept-language')[0];
        $language = explode(',', $language)[0];
        $language = explode('-', $language)[0];
    }

    $whitelist = [
        'de' => 'de_CH',
        'en' => 'en_US',
    ];
    if (!isset($whitelist[$language])) {
        throw new NotFoundException($request, $response);
    }

    if (!$hasLanguage) {
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

    return $next($request, $response);
});
