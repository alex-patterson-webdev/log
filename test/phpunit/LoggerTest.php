<?php

namespace ArpTest\Log;

use Arp\Log\Logger;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package ArpTest\Log
 */
final class LoggerTest extends TestCase
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Prepare the test case dependencies.
     *
     * @return void
     */
    public function setUp() : void
    {
        $this->logger = $this->getMockForAbstractClass(LoggerInterface::class);
    }

    /**
     * Assert that the logger class implements the PSR LoggerInterface.
     *
     * @covers \Arp\Log\Logger
     */
    public function testImplementsLoggerInterface() : void
    {
        $logger = new Logger($this->logger);

        $this->assertInstanceOf(LoggerInterface::class, $logger);
    }

    /**
     * Assert that calls to log proxy to the wrapped logger instance.
     *
     * @param string $level
     * @param string $message
     * @param array  $context
     *
     * @dataProvider getLogWillProxyToLoggerLogData
     * @covers \Arp\Log\Logger::log
     */
    public function testLogWillProxyToLoggerLog(string $level, string $message, array $context = []) : void
    {
        $logger = new Logger($this->logger);

        $this->logger->expects($this->once())
            ->method('log')
            ->with($level, $message, $context);

        $logger->log($level, $message, $context);
    }

    /**
     * @return array
     */
    public function getLogWillProxyToLoggerLogData() : array
    {
        return [
            [
                LogLevel::ERROR,
                'This is an error message to log!',
            ],
            [
                LogLevel::DEBUG,
                'This is an debug message to log!',
            ],
            [
                LogLevel::ALERT,
                'This is an alert message to log!',
                [
                    'boo' => 'hello',
                    123 => 'Some more context',
                ]

            ],
        ];
    }
}
