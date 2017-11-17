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
    private $router;
    private $canonical;

    /**
     * AppController constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->engine = $container->get(Engine::class);
        $this->router = $container->get('router');
        $this->canonical = $container->get('canonical');
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
            'base' => $this->router->pathFor("root"),
            'canonical' => $this->canonical,
        ];
        $viewData = array_merge_recursive($viewData, $default);
        $this->engine->addData($viewData);
        return $this->engine->render($file, $viewData);
    }
}
