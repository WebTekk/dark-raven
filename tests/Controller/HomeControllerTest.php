<?php
/**
 * Created by PhpStorm.
 * User: marc.wilhelm
 * Date: 18.01.2018
 * Time: 14:25
 */

namespace App\Test\Controller;


use App\Test\ApiTestCase;
use Exception;
use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;

/**
 * Class IndexControllerTest
 * @coversDefaultClass App\Controller\HomeController
 */
class HomeControllerTest extends ApiTestCase
{
    /**
     * Test home page
     *
     * @covers ::index
     * @throws MethodNotAllowedException
     * @throws Exception
     * @throws NotFoundException
     */
    public function testIndex()
    {
        $request = $this->createRequest('GET', '/');
        $response = $this->request($request);
        $this->assertEquals(302, $response->getStatusCode());
    }
}
