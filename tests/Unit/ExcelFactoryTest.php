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

    /**
     * @dataProvider \RoundPartner\Tests\Provider\FormatProvider::provideTwoWorkSheets()
     *
     * @param mixed $input
     */
    public function testExcelReturnAsFile($input)
    {
        $result = ExcelFactory::asFile($input, tempnam('/tmp/', 'test'));
        $this->assertTrue($result);
    }

    /**
     * @dataProvider \RoundPartner\Tests\Provider\FormatProvider::provideTwoWorkSheets()
     *
     * @param mixed $input
     */
    public function testExcelReturnsAsCloud($input)
    {
        $config = \RoundPartner\Conf\Service::get('testclouddocument');
        $containerName = $config['name'];
        $config = \RoundPartner\Conf\Service::get('opencloud');
        $client = \RoundPartner\Cloud\CloudFactory::create($config['username'], $config['key'], $config['secret']);
        $result = ExcelFactory::asCloud($input, $client, $containerName, 'text_excel.xlsx');
        $this->assertTrue($result);
    }
}
