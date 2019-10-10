<?php


use fize\provider\ipinfo\IpInfo;
use PHPUnit\Framework\TestCase;

class IpInfoTest extends TestCase
{

    public function testGetInstance()
    {
        $ipinfo = IpInfo::getInstance()->get('27.154.24.2');
        var_dump($ipinfo);
        self::assertIsObject($ipinfo);
    }
}
