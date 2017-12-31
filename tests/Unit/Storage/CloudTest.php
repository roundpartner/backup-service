<?php

namespace RoundPartner\Tests\Unit\Storage;

use RoundPartner\Backup\Result;
use RoundPartner\Backup\Storage\Cloud;
use OpenCloud\Tests\MockSubscriber;

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
        $this->containerName = 'test_cloud_document_container';
        $client = new \RoundPartner\Cloud\Cloud($this->newClient(), 'secret');

        $this->instance = new Cloud($client, $this->containerName, 'test_document.txt');

        $mockSubscriber = new MockSubscriber(array(
            '../../../vendor/rackspace/php-opencloud/tests/OpenCloud/Tests/_response/Auth.resp'
        ));
        $client->getClient()->addSubscriber($mockSubscriber);
    }

    public function testCreateInstance()
    {
        $this->assertInstanceOf('\RoundPartner\Backup\Storage\Cloud', $this->instance);
    }

    public function testStore()
    {
        $result = new Result();
        $result->setContents('data');
        $result = $this->instance->store($result, 'DFW');
        $this->assertTrue($result);
    }

    public function newClient()
    {
        return new \RoundPartner\Cloud\Service\Cloud(\OpenCloud\Rackspace::US_IDENTITY_ENDPOINT, array(
            'username' => 'foo',
            'apiKey'   => 'bar'
        ));
    }
}
