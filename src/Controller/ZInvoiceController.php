<?php

namespace App\Controller;


use App\Mapper\ZInvoiceMapper;
use Cake\Database\Connection;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class ZInvoiceController extends AppController
{
    /**
     * @var Connection
     */
    protected $db;

    /**
     * EventController constructor.
     * @param Container $container Container
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function __construct(Container $container)
    {
        parent::__construct($container);
        $this->db = $container->get(Connection::class);
    }

    /**
     * Return xml data
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function index(Request $request, Response $response): Response
    {
        $mapper = new ZInvoiceMapper($this->db);
        $data = $mapper->getXmlData();
        return $this->render($request, $response, 'ZInvoice/zinvoice.twig', ['data' => $data]);
    }
}
