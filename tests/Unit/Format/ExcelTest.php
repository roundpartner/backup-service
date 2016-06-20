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

    /**
     * @dataProvider \RoundPartner\Tests\Provider\FormatProvider::provide()
     *
     * @param mixed $input
     */
    public function testGetWorkBook($input)
    {
        $this->instance->setInput($input);
        $workbook = $this->instance->getWorkBook();
        $this->assertInstanceOf('\PHPExcel', $workbook);
    }

    /**
     * @dataProvider \RoundPartner\Tests\Provider\FormatProvider::provideTwoWorkSheets()
     *
     * @param mixed $input
     */
    public function testCreatesTwoWorkSheets($input)
    {
        $this->instance->setInput($input);
        $workbook = $this->instance->getWorkBook();
        $this->assertCount(2, $workbook->getAllSheets());
    }

    /**
     * @dataProvider \RoundPartner\Tests\Provider\FormatProvider::provideTwoWorkSheets()
     *
     * @param mixed $input
     */
    public function testWorkSheetIsNamed($input)
    {
        $this->instance->setInput($input);
        $workbook = $this->instance->getWorkBook();
        $this->assertContains('Planes', $workbook->getSheetNames());
    }

    /**
     * @dataProvider \RoundPartner\Tests\Provider\FormatProvider::provide()
     *
     * @param mixed $input
     */
    public function testCreatorIsSet($input)
    {
        $this->instance->setInput($input);
        $this->assertEquals('Tom', $this->instance->getWorkBook()->getProperties()->getCreator());
    }

    /**
     * @dataProvider \RoundPartner\Tests\Provider\FormatProvider::provide()
     *
     * @param mixed $input
     */
    public function testLastModifiedByIsSet($input)
    {
        $this->instance->setInput($input);
        $this->assertEquals('Tom', $this->instance->getWorkBook()->getProperties()->getLastModifiedBy());
    }

    /**
     * @dataProvider \RoundPartner\Tests\Provider\FormatProvider::provide()
     *
     * @param mixed $input
     */
    public function testGetDescription($input)
    {
        $this->instance->setInput($input);
        $this->assertEquals('Description of the worksheet', $this->instance->getWorkBook()->getProperties()->getDescription());
    }

    /**
     * @dataProvider \RoundPartner\Tests\Provider\FormatProvider::provideTwoWorkSheets()
     *
     * @param mixed $input
     */
    public function testSaveOutput($input)
    {
        $this->instance->setInput($input);
        $content = $this->instance->getOutput()->getContents();
        file_put_contents('output.xlsx', $content);
    }
}
