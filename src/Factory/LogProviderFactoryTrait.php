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

    /***
     * Allow the logger factory to be publicly set.
     *
     * @param FactoryInterface $loggerFactory
     */
    public function setLoggerFactory(FactoryInterface $loggerFactory): void
    {
        $this->loggerFactory = $loggerFactory;
    }

    /**
     * Return the log factory instance.
     *
     * @param array $factoryOptions
     *
     * @return FactoryInterface
     */
    protected function getLoggerFactory(array $factoryOptions = []): FactoryInterface
    {
        if (null === $this->loggerFactory) {
            $this->setLoggerFactory($this->createDefaultLoggerFactory($factoryOptions));
        }
        return $this->loggerFactory;
    }

    /**
     * Create the default logger instance.
     *
     * @param array $options The optional logger factory creation options
     *
     * @return FactoryInterface
     */
    protected function createDefaultLoggerFactory(array $options = []): FactoryInterface
    {
        $className = NullLoggerFactory::class;

        if (isset($this->defaultLoggerFactory)) {
            $className = $this->defaultLoggerFactory;
        } elseif (isset($options['class_name'])) {
            $className = $options['class_name'];
        }

        return new $className();
    }
}
