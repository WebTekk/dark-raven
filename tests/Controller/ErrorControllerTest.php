<?php

namespace App\Test\Controller;

use App\Test\ApiTestCase;
use Exception;
use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;

/**
 * Class ErrorControllerTest
 *
 * @coversDefaultClass App\Controller\ErrorController
 */
class ErrorControllerTest extends ApiTestCase
{
    /**
     * Test notFoundAction
     *
     * @covers ::notFoundAction
     * @return void
     * @throws Exception
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     */
    public function testNotFoundAction()
    {
        $request = $this->createRequest('GET', '/de/notFound');
        $response = $this->request($request);
        $this->assertEquals(302, $response->getStatusCode());
    }
}
