<?php

namespace RoundPartner\Tests\Unit\Format;

use RoundPartner\Backup\Format\WorkSheet;

class WorkSheetTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \PHPExcel
     */
    protected $excelWorksheet;

    /**
     * @var WorkSheet
     */
    protected $instance;

    public function setUp()
    {
        $this->excelWorksheet = new \PHPExcel();
        $this->instance = new WorkSheet($this->excelWorksheet);
    }

    public function testInstanceCreated()
    {
        $this->assertInstanceOf('RoundPartner\Backup\Format\WorkSheet', $this->instance);
    }
}
