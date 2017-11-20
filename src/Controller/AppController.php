<?php

namespace App\Controller;

use League\Plates\Engine;
use Slim\Collection;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Router;

/**
 * Class AppController
 */
class AppController
{
    /**
     * @var Engine
     */
    private $engine;

    /**
     * @var Router
     */
    protected $router;

    /**
     * @var Collection
     */
    protected $settings;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * AppController constructor.
     *
     * @param Container $container Container
     */
    public function __construct(Container $container)
    {
        $this->engine = $container->get(Engine::class);
        $this->router = $container->get('router');
        $this->settings = $container->get('settings');
        $this->request = $container->get('request');
        $this->response = $container->get('response');
    }

    /**
     * Render HTML file.
     *
     * @param string $file
     * @param array $viewData
     * @return string rendered HTML File
     */
    public function render(string $file, array $viewData): string
    {
        $default = [
            'root' => $this->router->pathFor('root'),
            'canonical' => $this->settings->get('canonical'),
        ];
        $viewData = array_merge_recursive($viewData, $default);
        $this->engine->addData($viewData);
        return $this->engine->render($file, $viewData);
    }
}
