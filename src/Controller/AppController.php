<?php

namespace App\Controller;

use League\Plates\Engine;
use Slim\Container;
use Slim\Route;

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
     * @var Route
     */
    private $router;

    /**
     * @var string
     */
    private $canonical;

    /**
     * AppController constructor.
     *
     * @param Container $container Container
     */
    public function __construct(Container $container)
    {
        $this->engine = $container->get(Engine::class);
        $this->router = $container->get('router');
        $this->canonical = $container->get('settings')->get('canonical');
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
            'base' => $this->router->pathFor("root"),
            'canonical' => $this->canonical,
        ];
        $viewData = array_merge_recursive($viewData, $default);
        $this->engine->addData($viewData);
        return $this->engine->render($file, $viewData);
    }
}
