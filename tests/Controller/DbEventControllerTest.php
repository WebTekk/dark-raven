<?php

namespace App\Test\Controller;

use App\Test\DbTestCase;
use Exception;
use PHPUnit\DbUnit\DataSet\ArrayDataSet;
use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;

/**
 * Class EventControllerTest
 *
 * @coversDefaultClass App\Controller\EventController
 */
class DbEventControllerTest extends DbTestCase
{
    private $data = [
        'events' => [
            [
                'id' => 1,
                'name' => 'Event1',
                'date' => '2018-01-01 00:00:00',
                'location' => 'Location 1',
            ],
            [
                'id' => 2,
                'name' => 'Event2',
                'date' => '2018-01-01 00:00:01',
                'location' => 'Location 2',
            ],
        ],
    ];

    /**
     * Get data set.
     *
     * @return ArrayDataSet|\PHPUnit\DbUnit\DataSet\IDataSet
     */
    protected function getDataSet()
    {
        return new ArrayDataSet($this->data);
    }

    /**
     * Test EventController::index
     *
     * @covers ::index
     * @covers \App\Controller\AppController::render
     * @covers \App\Controller\AppController::__construct
     *
     * @return void
     * @throws Exception
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     */
    public function testIndex()
    {
        $request = $this->createRequest('GET', '/de/events');
        $response = $this->request($request);
        $this->assertEquals(200, $response->getStatusCode());
        $body = (string)$response->getBody();
        $this->assertContains('div', $body);
    }

    /**
     * Test EventController::load
     *
     * @covers ::load
     * @return void
     * @throws Exception
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     */
    public function testLoad()
    {
        $request = $this->createRequest('GET', '/de/events/load');
        $response = $this->request($request);
        $this->assertEquals(200, $response->getStatusCode());
        $body = (string)$response->getBody();
        $this->assertJson($body);
    }
}
