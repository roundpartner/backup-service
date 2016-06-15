<?php

namespace RoundPartner\Tests;

use RoundPartner\Backup\Result;

class JsonTest extends \PHPUnit_Framework_TestCase
{
    const TEST_DATA = 'Test Data';

    /**
     * @var Result
     */
    protected $instance;

    public function setUp()
    {
        $this->instance = new Result();
    }

    public function testNewInstance()
    {
        $this->assertInstanceOf('RoundPartner\Backup\Result', $this->instance);
    }

    public function testSetContents()
    {
        $this->assertTrue($this->instance->setContents(self::TEST_DATA));
    }

    public function testGetContents()
    {
        $this->instance->setContents(self::TEST_DATA);
        $this->assertEquals(self::TEST_DATA, $this->instance->getContents());
    }
}
