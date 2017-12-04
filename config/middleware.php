<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Symfony\Component\Translation\Loader\MoFileLoader;
use Symfony\Component\Translation\Translator;

$app = app();
$container = $app->getContainer();

$app->add(function (Request $request, Response $response, $next) use ($container) {
    $locale = $request->getAttribute('language');
    if ($locale == 'de') {
        $locale = 'de_DE';
    }

    $translator = $container->get(Translator::class);

    $resource = __DIR__ . "/../resources/locale/" . $locale . "_messages.mo";

    $translator->setLocale($locale);
    $translator->setFallbackLocales(['en_US']);
    $translator->addLoader('mo', new MoFileLoader());
    $translator->addResource('mo', $resource, $locale);
    $translator->setLocale($locale);

    return $next($request, $response);
});

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
