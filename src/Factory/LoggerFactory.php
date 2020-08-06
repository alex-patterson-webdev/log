<?php

declare(strict_types=1);

namespace Arp\Log\Factory;

use Arp\Factory\Exception\FactoryException;
use Arp\Factory\FactoryInterface;
use Laminas\Log\PsrLoggerAdapter;
use Psr\Log\LoggerInterface;

/**
 * Default factory class to create a new LoggerInterface from configuration options.
 *
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\Log\Factory
 */
class LoggerFactory implements FactoryInterface
{
    /**
     * Create a new Logger instance based on the provided $config.
     *
     * @param array $config The factory configuration options.
     *
     * @return LoggerInterface
     *
     * @throws FactoryException  If the service cannot be created.
     */
    public function create(array $config = []): LoggerInterface
    {
        $laminasLogger = (new LaminasLoggerFactory())->create($config);

        return new PsrLoggerAdapter($laminasLogger);
    }
}
