<?php

namespace RoundPartner\Tests\Unit;

use RoundPartner\Backup\ExcelFactory;

class ExcelFactoryTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider \RoundPartner\Tests\Provider\FormatProvider::provideTwoWorkSheets()
     *
     * @param mixed $input
     */
    public function testExcelReturnsString($input)
    {
        $result = ExcelFactory::asString($input);
        $this->assertInternalType('string', $result);
    }
}
