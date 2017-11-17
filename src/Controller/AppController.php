<?php

namespace App\Controller;

use League\Plates\Engine;
use Slim\Container;

/**
 * Class AppController
 */
class AppController
{
    private $engine;
    private $container;

    /**
     * AppController constructor.
     *
     * @param Engine $engine
     * @param Container $container
     */
    public function __construct(Engine $engine, Container $container)
    {
        $this->engine = $engine;
        $this->container = $container;
    }

    /**
     * Render HTML file.
     *
     * @param string $file
     * @param array $viewData
     * @return string rendered HTML File
     */
    public function render(string $file, array $viewData)
    {
        $default = [
            'base' => $this->container->get('router')->pathFor("root"),
            'canonical' => $this->container->get('canonical')
        ];
        $viewData = array_merge_recursive($viewData, $default);
        $this->engine->addData($viewData);
        return $this->engine->render($file, $viewData);
    }
}
