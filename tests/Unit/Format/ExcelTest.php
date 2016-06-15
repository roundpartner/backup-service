<?php

namespace RoundPartner\Tests\Unit\Format;

use RoundPartner\Backup\Format\Excel;

class ExcelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Excel
     */
    protected $instance;

    public function setUp()
    {
        $this->instance = new Excel();
    }

    public function testInit()
    {
        $this->assertInstanceOf('RoundPartner\Backup\Format\Excel', $this->instance);
    }

    public function testSetInputReturnsTrue()
    {
        $this->assertTrue($this->instance->setInput(''));
    }

    public function testOutputTypeOfResult()
    {
        $this->assertInstanceOf('RoundPartner\Backup\Result', $this->instance->getOutput());
    }

    public function testOutputAsString()
    {
        $this->assertInternalType('string', $this->instance->getOutput()->getContents());
    }
}
