<?php

namespace RoundPartner\Tests\Unit;

use RoundPartner\Backup\ExcelFactory;
use OpenCloud\Tests\MockSubscriber;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

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

    /**
     * @dataProvider \RoundPartner\Tests\Provider\FormatProvider::provideTwoWorkSheets()
     *
     * @param mixed $input
     */
    public function testExcelReturnsAsFreezer($input)
    {

        $client = $this->getClientMock([new Response(204, [], '')]);

        $result = ExcelFactory::asFreezer($input, 'backup', 'text_excel.xlsx', $client);
        $this->assertTrue($result);
    }

    private function newClient()
    {
        return new \RoundPartner\Cloud\Service\Cloud(\OpenCloud\Rackspace::US_IDENTITY_ENDPOINT, array(
            'username' => 'foo',
            'apiKey'   => 'bar'
        ));
    }

    /**
     * @param Response[] $responses
     *
     * @return Client
     */
    protected function getClientMock($responses)
    {
        $mock = new MockHandler($responses);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        return $client;
    }
}
