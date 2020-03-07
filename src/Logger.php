<?php

namespace Arp\Log;

use Psr\Log\AbstractLogger;
use Psr\Log\InvalidArgumentException;
use Psr\Log\LoggerInterface;

/**
 * Proxy logger for other PSR implementations.
 *
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\Log
 */
class Logger extends AbstractLogger
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Logs with an arbitrary level
     *
     * @param mixed  $level
     * @param string $message
     * @param array  $context
     *
     * @return void
     *
     * @throws InvalidArgumentException
     */
    public function log($level, $message, array $context = []) : void
    {
        $this->logger->log($level, $message, $context);
    }
}