<?php

namespace RoundPartner\Tests\Unit\Storage;

use RoundPartner\Backup\Result;
use RoundPartner\Backup\Storage\Cloud;

class CloudTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \RoundPartner\Backup\Storage\Cloud
     */
    protected $instance;

    /**
     * @var string
     */
    protected $containerName;

    public function setUp()
    {
        $config = \RoundPartner\Conf\Service::get('testclouddocument');
        $this->containerName = $config['name'];
        $config = \RoundPartner\Conf\Service::get('opencloud');
        $client = \RoundPartner\Cloud\CloudFactory::create($config['username'], $config['key'], $config['secret']);
        $this->instance = new Cloud($client, $this->containerName, 'test_document.txt');
    }

    public function testCreateInstance()
    {
        $this->assertInstanceOf('\RoundPartner\Backup\Storage\Cloud', $this->instance);
    }

    public function testStore()
    {
        $result = new Result();
        $result->setContents('data');
        $result = $this->instance->store($result);
        $this->assertTrue($result);
    }
}
