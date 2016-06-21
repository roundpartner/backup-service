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
}
