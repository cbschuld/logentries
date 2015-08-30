<?php

namespace cbschuld\LogEntries\Tests;

use cbschuld\LogEntries;
use Psr\Log\LogLevel;

class LogEntriesTest extends \PHPUnit_Framework_TestCase
{
    const TOKEN = '2bfbea1e-10c3-4419-bdad-7e6435882e1f'; // test token from LogEntries docs


    public function testSingleton()
    {
        $log = LogEntries::getLogger(self::TOKEN);
        $this->assertInstanceOf('cbschuld\LogEntries', $log);
        $log->tearDown();
    }

    public function testIsPersistent()
    {
        $log = LogEntries::getLogger(self::TOKEN, false, true, false, "", 10000, "");
        $this->assertFalse($log->isPersistent());
        $log->tearDown();

        $log = LogEntries::getLogger(self::TOKEN, true, true, false, "", 10000, "");
        $this->assertTrue($log->isPersistent());
        $log->tearDown();
    }

    public function testLogString()
    {
        $hostname = gethostname();
        $log = LogEntries::getLogger(self::TOKEN, false, true, false, "", 10000, $hostname);
        $log->log(LogLevel::DEBUG, "example log via string");
        $log->tearDown();
    }

    public function testLogJSON()
    {
        $json = array(
            "datetime" => new \DateTime("now"),
            "hostname" => gethostname(),
            "status" => "ok",
            "test" => "testLogJSON"
        );
        $log = LogEntries::getLogger(self::TOKEN, false, true, false, "", 10000, "");
        $log->log(LogLevel::DEBUG, json_encode($json));
        $log->tearDown();
    }

    public function testLogEmergencySimpleStartup()
    {
        $json = array(
            "datetime" => new \DateTime("now"),
            "hostname" => gethostname(),
            "status" => "ok",
            "test" => "testLogEmergencySimpleStartup"
        );
        $log = LogEntries::getLogger(self::TOKEN);
        $log->log(LogLevel::EMERGENCY, json_encode($json));
        $log->tearDown();
    }

    public function testLogSimpleEmergencySimpleStartup()
    {
        $json = array(
            "datetime" => new \DateTime("now"),
            "hostname" => gethostname(),
            "status" => "ok",
            "test" => "testLogSimpleEmergencySimpleStartup"
        );
        $log = LogEntries::getLogger(self::TOKEN);
        $log->emergency(json_encode($json));
        $log->tearDown();
    }

    public function testSSL()
    {
        $json = array(
            "datetime" => new \DateTime("now"),
            "hostname" => gethostname(),
            "status" => "ok",
            "ssl" => true,
            "test" => "testSSL"
        );
        $log = LogEntries::getLogger(self::TOKEN,true,true);
        $log->info(json_encode($json));
        $log->tearDown();
    }

}
