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
}
