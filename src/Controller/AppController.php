<?php

namespace App\Controller;

use Interop\Container\Exception\ContainerException;
use League\Plates\Engine;
use Slim\Collection;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Router;
use Slim\Views\Twig;
use SlimSession\Helper as SessionHelper;

/**
 * Class AppController
 */
class AppController
{
    /**
     * @var SessionHelper
     */
    protected $session;

    /**
     * @var Twig
     */
    private $twig;

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
     * @throws ContainerException
     */
    public function __construct(Container $container)
    {
        $this->twig = $container->get(Twig::class);
        $this->router = $container->get('router');
        $this->settings = $container->get('settings');
        $this->request = $container->get('request');
        $this->response = $container->get('response');
        $this->session = $container->get(SessionHelper::class);
    }

    /**
     * Render HTML file.
     *
     * @param string $file
     * @param array $viewData
     * @return Response
     */
    public function render(string $file, array $viewData): Response
    {
        $default = [
            'root' => $this->router->pathFor('root'),
            'canonical' => $this->settings->get('canonical'),
        ];
        $viewData = array_merge_recursive($viewData, $default);
        return $this->twig->render($this->response, $file, $viewData);
    }
}
