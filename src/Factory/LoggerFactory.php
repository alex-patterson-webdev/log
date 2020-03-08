<?php

namespace Arp\Log\Factory;

use Arp\Factory\Exception\FactoryException;
use Arp\Factory\FactoryInterface;
use Arp\Log\Logger;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Default factory class to create a new LoggerInterface from configuration options.
 *
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\Log\Factory
 */
class LoggerFactory implements FactoryInterface
{
    /**
     * @var string
     */
    private $defaultClassName = Logger::class;

    /**
     * Create a new Logger instance based on the provided $config.
     *
     * @param array $config The factory configuration options.
     *
     * @return LoggerInterface
     *
     * @throws FactoryException  If the service cannot be created.
     */
    public function create(array $config = []) : LoggerInterface
    {
        $className = $config['class_name'] ?? $this->defaultClassName;
        $logger    = $config['logger']     ?? NullLogger::class;

        if (! is_a($className, LoggerInterface::class, true)) {
            throw new FactoryException(sprintf(
                'The \'class_name\' option must be a class that implements \'%s\'; \'%s\' provided in \'%s\'',
                LoggerInterface::class,
                is_string($className) ? $className : gettype($className),
                static::class
            ));
        }

        if (empty($logger)) {
            throw new FactoryException(sprintf(
                'The required \'logger\' configuration option is missing or invalid in \'%s\'',
                static::class
            ));
        }

        return new $className($this->getLogger($logger));
    }

    /**
     * Return the wrapped logger instance.
     *
     * @param LoggerInterface|string $logger The logger instance or class name.
     *
     * @return LoggerInterface
     *
     * @throws FactoryException If the logger cannot be created.
     */
    protected function getLogger($logger) : LoggerInterface
    {
        if (is_string($logger)) {
            if (! is_a($logger, LoggerInterface::class, true)) {
                throw new FactoryException(sprintf(
                    'The \'logger\' option must be a class that implements \'%s\'; \'%s\' provided in \'%s\'',
                    LoggerInterface::class,
                    $logger,
                    static::class
                ));
            }

            $logger = new $logger;
        }

        if (! $logger instanceof LoggerInterface) {
            throw new FactoryException(sprintf(
                'The \'logger\' option must be an object that implements \'%s\'; \'%s\' provided in \'%s\'',
                LoggerInterface::class,
                is_object($logger) ? get_class($logger) : gettype($logger),
                static::class
            ));
        }

        return $logger;
    }
}
