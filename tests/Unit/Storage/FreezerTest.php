<?php

namespace RoundPartner\Tests\Unit\Storage;

use RoundPartner\Backup\Storage\Freezer;
use RoundPartner\Backup\Result;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class FreezerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \RoundPartner\Backup\Storage\Freezer
     */
    protected $instance;

    public function setUp()
    {
        $this->instance = new Freezer('backups', 'document.xls');
    }

    public function testCreateInstance()
    {
        $this->assertInstanceOf('RoundPartner\Backup\Storage\Freezer', $this->instance);
    }

    /**
     * @param Response[] $responses
     *
     * @dataProvider \RoundPartner\Tests\Provider\ResponseProvider::success()
     */
    public function testStoresFile($responses)
    {
        $client = $this->getClientMock($responses);
        $this->instance->setClient($client);
        $result = new Result();
        $result->setContents('data');
        $this->assertTrue($this->instance->store($result));
    }

    /**
     * @param Response[] $responses
     *
     * @return Client
     */
    protected function getClientMock($responses)
    {
        $mock = new MockHandler($responses);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        return $client;
    }
}
