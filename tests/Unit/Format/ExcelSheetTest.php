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
        $alphabetData = FormatProvider::providePhoneticAlphabet();
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
        $this->assertEquals('Letter', $cell->getValue());
    }

    public function testHeadingIsBold()
    {
        $cell = $this->instance->process()->getCell('A1');
        $this->assertTrue($cell->getStyle()->getFont()->getBold());
    }
}
