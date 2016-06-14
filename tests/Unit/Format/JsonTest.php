<?php

namespace RoundPartner\Tests\Format;

use RoundPartner\Backup\Format\Json;

class JsonTest extends \PHPUnit_Framework_TestCase
{
    public function testInit()
    {
        $instance = new Json();
        $this->assertInstanceOf('RoundPartner\Backup\Format\Json', $instance);
    }
}
