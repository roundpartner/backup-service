<?php

namespace RoundPartner\Tests\Unit\Transcriber;

use RoundPartner\Backup\Transcriber\Excel;

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
        $this->assertInstanceOf('RoundPartner\Backup\Transcriber\Excel', $this->instance);
    }

    public function testGetPositionOnStart()
    {
        $this->assertEquals('A0', $this->instance->getPosition('alpha', ''));
    }

    public function testGetPositionOnSecondColumn()
    {
        $this->instance->getPosition('alpha', '');
        $this->assertEquals('B0', $this->instance->getPosition('bravo', ''));
    }
    
    public function testGetPositionOnSecondRow()
    {
        $this->instance->createSet();
        $this->assertEquals('A1', $this->instance->getPosition('alpha', ''));
    }

    public function testGetHeadings()
    {
        $this->instance->getPosition('alpha', '');
        $this->assertNotEmpty($this->instance->getHeadings());
    }
}
