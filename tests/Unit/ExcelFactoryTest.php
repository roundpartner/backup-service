<?php

namespace RoundPartner\Tests\Unit;

use RoundPartner\Backup\ExcelFactory;
use OpenCloud\Tests\MockSubscriber;

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
        $client = new \RoundPartner\Cloud\Cloud($this->newClient(), new \GuzzleHttp\Client(), 'secret');
        $mockSubscriber = new MockSubscriber(array(
            BASE_PATH . '/vendor/rackspace/php-opencloud/tests/OpenCloud/Tests/_response/Auth.resp'
        ));
        $client->getClient()->addSubscriber($mockSubscriber);

        $containerName = 'test_cloud_document_container';
        $result = ExcelFactory::asCloud($input, $client, $containerName, 'text_excel.xlsx', 'DFW');
        $this->assertTrue($result);
    }

    private function newClient()
    {
        return new \RoundPartner\Cloud\Service\Cloud(\OpenCloud\Rackspace::US_IDENTITY_ENDPOINT, array(
            'username' => 'foo',
            'apiKey'   => 'bar'
        ));
    }
}
