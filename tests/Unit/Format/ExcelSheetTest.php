<?php

namespace RoundPartner\Tests\Unit\Format;

use RoundPartner\Backup\Format\ExcelSheet;
use RoundPartner\Tests\Provider\FormatProvider;

class ExcelSheetTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ExcelSheet
     */
    protected $instance;

    /**
     * @var \PHPExcel
     */
    protected $excelWorksheet;

    public function setUp()
    {
        $alphabetData = FormatProvider::provideAircraft();
        $this->excelWorksheet = new \PHPExcel();
        $this->instance = new ExcelSheet($this->excelWorksheet, $alphabetData);
    }

    public function testCreateInstance()
    {
        $this->assertInstanceOf('RoundPartner\Backup\Format\ExcelSheet', $this->instance);
    }

    public function testProcessReturnsActiveStyleSheetInstance()
    {
        $this->assertInstanceOf('\PHPExcel_Worksheet', $this->instance->process());
    }

    public function testCreatesHeadingsOnFirstRow()
    {
        $cell = $this->instance->process()->getCell('A1');
        $this->assertEquals('Make', $cell->getValue());
    }

    public function testHeadingIsBold()
    {
        $cell = $this->instance->process()->getCell('A1');
        $this->assertTrue($cell->getStyle()->getFont()->getBold());
    }

    public function testOnlyValuesWithHeadingsPresent()
    {
        $cell = $this->instance->process()->getCell('A2');
        $this->assertEquals('Supermarine', $cell->getValue());
    }

    public function testNoAdditionalHeadingColumnsAdded()
    {
        $cell = $this->instance->process()->getCell('D1');
        $this->assertEquals('', $cell->getValue());
    }

    public function testNoAdditionalColumnsAdded()
    {
        $cell = $this->instance->process()->getCell('D2');
        $this->assertEquals('', $cell->getValue());
    }
}
