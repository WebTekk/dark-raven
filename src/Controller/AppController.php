<?php

namespace App\Controller;

use League\Plates\Engine;

/**
 * Class AppController
 */
class AppController
{
    private $engine;

    /**
     * AppController constructor.
     *
     * @param Engine $engine
     */
    public function __construct(Engine $engine)
    {
        $this->engine = $engine;
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
            'router' => app()->getContainer()->get('router'),
            'canonical' => app()->getContainer()->get('canonical')
        ];
        $viewData = array_merge_recursive($viewData, $default);
        $this->engine->addData($viewData);
        return $this->engine->render($file, $viewData);
    }
}
