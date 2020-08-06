<?php

declare(strict_types=1);

namespace Arp\Log\Factory;

use Arp\Factory\Exception\FactoryException;
use Arp\Factory\FactoryInterface;
use Laminas\Log\Logger as LaminasLogger;

/**
 * Default factory class to create a new LoggerInterface from configuration options.
 *
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\Log\Factory
 */
abstract class AbstractLoggerFactory implements FactoryInterface
{
    /**
     * @var LaminasLoggerFactory
     */
    private $loggerFactory;

    /**
     * @var array
     */
    private $defaultConfig;

    /**
     * @param LaminasLoggerFactory|null $loggerFactory
     * @param array                     $defaultConfig
     */
    public function __construct(LaminasLoggerFactory $loggerFactory = null, array $defaultConfig = [])
    {
        if (null === $loggerFactory) {
            $loggerFactory = new LaminasLoggerFactory();
        }
        $this->loggerFactory = $loggerFactory;
        $this->defaultConfig = $defaultConfig;
    }

    /**
     * Create a new Logger instance based on the provided $config.
     *
     * @param array $config The factory configuration options.
     *
     * @return LaminasLogger
     *
     * @throws FactoryException  If the service cannot be created.
     */
    protected function createLaminasLogger(array $config = []): LaminasLogger
    {
        $config = array_replace_recursive($this->defaultConfig, $config);

        return $this->loggerFactory->create($config);
    }
}
