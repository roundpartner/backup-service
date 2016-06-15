<?php

namespace RoundPartner\Tests\Unit\Format;

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

    /**
     * @dataProvider \RoundPartner\Tests\Provider\FormatProvider::provide()
     *
     * @param mixed $input
     */
    public function testSetInputReturnsTrue($input)
    {
        $this->assertTrue($this->instance->setInput($input));
    }

    /**
     * @dataProvider \RoundPartner\Tests\Provider\FormatProvider::provide()
     *
     * @param mixed $input
     */
    public function testOutputTypeOfResult($input)
    {
        $this->instance->setInput($input);
        $this->assertInstanceOf('RoundPartner\Backup\Result', $this->instance->getOutput());
    }

    /**
     * @dataProvider \RoundPartner\Tests\Provider\FormatProvider::provide()
     *
     * @param mixed $input
     */
    public function testGetOutputReturnsJson($input)
    {
        $this->instance->setInput($input);
        $this->assertJson($this->instance->getOutput()->getContents());
    }
}
