<?php

namespace RoundPartner\Tests\Unit\Storage;

use RoundPartner\Backup\Result;
use RoundPartner\Backup\Storage\File;

class FileTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \RoundPartner\Backup\Storage\File
     */
    protected $instance;

    public function setUp()
    {
        $filename = tempnam('/tmp/', 'test');
        $this->instance = new File($filename);
    }

    public function testCreateInstance()
    {
        $this->assertInstanceOf('RoundPartner\Backup\Storage\File', $this->instance);
    }

    public function testStoresFile()
    {
        $result = new Result();
        $result->setContents('data');
        $this->assertTrue($this->instance->store($result));
    }
}
