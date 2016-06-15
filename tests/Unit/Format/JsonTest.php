<?php

namespace RoundPartner\Tests\Format;

use RoundPartner\Backup\Format\Json;

class JsonTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Json
     */
    protected $instance;

    public function setUp()
    {
        $this->instance = new Json();
    }

    public function testInit()
    {
        $this->assertInstanceOf('RoundPartner\Backup\Format\Json', $this->instance);
    }

    public function testOutputTypeOfResult()
    {
        $this->assertInstanceOf('RoundPartner\Backup\Result', $this->instance->getOutput());
    }

    public function testGetOutputReturnsJson()
    {
        $this->assertJson($this->instance->getOutput()->getContents());
    }
}
