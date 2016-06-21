<?php

namespace RoundPartner\Tests\Unit\Format;

use RoundPartner\Backup\Format\WorkBook;

class WorkBookTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \PHPExcel
     */
    protected $excelWorksheet;

    /**
     * @var WorkBook
     */
    protected $instance;

    public function setUp()
    {
        $this->excelWorksheet = new \PHPExcel();
        $this->instance = new WorkBook($this->excelWorksheet);
    }

    public function testInstanceCreated()
    {
        $this->assertInstanceOf('RoundPartner\Backup\Format\WorkBook', $this->instance);
    }

    public function testFalseIsReturnedOnEmptyContent()
    {
        $this->assertFalse($this->instance->process(null));
    }

    /**
     * @dataProvider \RoundPartner\Tests\Provider\FormatProvider::provide()
     *
     * @param mixed $input
     */
    public function testTrueOnProcessWithContent($input)
    {
        $this->assertTrue($this->instance->process($input['worksheets']));
    }
}
