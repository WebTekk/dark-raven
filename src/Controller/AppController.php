<?php

namespace App\Controller;

use Aura\Session\Session;
use Interop\Container\Exception\ContainerException;
use Slim\Collection;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Router;
use Slim\Views\Twig;

/**
 * Class AppController.
 */
class AppController
{
    /**
     * @var Session
     */
    protected $session;

    /**
     * @var Twig
     */
    private $twig;

    /**
     * @var Collection
     */
    protected $settings;

    /**
     * @var Router
     */
    protected $router;

    /**
     * AppController constructor.
     *
     * @param Container $container Container
     *
     * @throws ContainerException
     */
    public function __construct(Container $container)
    {
        $this->twig = $container->get(Twig::class);
        $this->settings = $container->get('settings');
        $this->session = $container->get(Session::class);
        $this->router = $container->get('router');
    }

    /**
     * Render HTML file.
     *
     * @param Request $request
     * @param Response $response
     * @param string $file
     * @param array $viewData
     *
     * @return Response
     */
    public function render(Request $request, Response $response, string $file, array $viewData): Response
    {
        $segment = $this->session->getSegment('session');
        $loggedIn = !empty($segment->get('username'));
        $default = [
            'canonical' => $this->settings->get('canonical'),
            'language' => $request->getAttribute('language'),
            'loggedIn' => $loggedIn,
        ];
        if ($loggedIn) {
            $default['user'] = [
                'userId' => $segment->get('userId'),
                'username' => $segment->get('username'),
                'role' => $segment->get('role'),
            ];
        }
        $viewData = array_merge_recursive($viewData, $default);

        return $this->twig->render($response, $file, $viewData);
    }
}
