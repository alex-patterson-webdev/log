<?php

declare(strict_types=1);

namespace Arp\Log\Factory;

use Arp\Factory\Exception\FactoryException;
use Arp\Factory\FactoryInterface;
use Psr\Log\LoggerInterface;

/**
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\Log\Factory
 */
trait LogProviderFactoryTrait
{
    /**
     * @var FactoryInterface
     */
    protected $loggerFactory;

    /**
     * Create a new logger instance.
     *
     * @param array|LoggerInterface $logger
     *
     * @return LoggerInterface
     *
     * @throws FactoryException
     */
    protected function createLogger($logger): LoggerInterface
    {
        if (is_array($logger)) {
            $logger = $this->getLoggerFactory()->create($logger);
        }

        if (!$logger instanceof LoggerInterface) {
            throw new FactoryException('Failed to create logger instance');
        }

        return $logger;
    }

    /**
     * Return the log factory instance.
     *
     * @return FactoryInterface
     */
    protected function getLoggerFactory(): FactoryInterface
    {
        if (null === $this->loggerFactory) {
            $this->loggerFactory = new NullLoggerFactory();
        }
        return $this->loggerFactory;
    }
}