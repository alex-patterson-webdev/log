<?php

declare(strict_types=1);

namespace Arp\Log\Factory;

use Arp\Factory\Exception\FactoryException;
use Arp\Factory\FactoryInterface;
use Laminas\Log\Logger as LaminasLogger;
use Laminas\Log\Processor\ProcessorInterface;
use Laminas\Log\Writer\WriterInterface;

/**
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\Log\Factory
 */
class LaminasLoggerFactory implements FactoryInterface
{
    /**
     * Create a new LaminasLogger instance using the provided $config.
     *
     * @param array $config
     *
     * @return LaminasLogger
     *
     * @throws FactoryException If the logger cannot be created
     */
    public function create(array $config = []): LaminasLogger
    {
        $options = [
            'exceptionhandler'             => $config['exception_handler'] ?? null,
            'errorhandler'                 => $config['error_handler'] ?? null,
            'fatal_error_shutdownfunction' => $config['fatal_error_shutdown_function'] ?? null,
        ];

        $logger = new LaminasLogger($options);

        if (!empty($config['writers'])) {
            $this->addWriters($logger, $config['writers']);
        }

        if (!empty($config['processors'])) {
            $this->addProcessors($logger, $config['processors']);
        }

        return $logger;
    }

    /**
     * Add a collection of log writers resolved from the provided configuration.
     *
     * @param LaminasLogger $logger
     * @param array         $config
     *
     * @throws FactoryException If a writer cannot be created.
     */
    private function addWriters(LaminasLogger $logger, array $config): void
    {
        foreach ($config as $writerName => $writerConfig) {
            try {
                if ($writerConfig instanceof WriterInterface) {
                    $logger->addWriter($writerConfig);
                    continue;
                }

                if (is_string($writerName)) {
                    $logger->addWriter($writerName, null, is_array($writerConfig) ? $writerConfig : []);
                    continue;
                }
            } catch (\Throwable $e) {
                throw new FactoryException(
                    sprintf('Failed to create writer at index \'%s\': %s', $writerName, $e->getMessage()),
                    $e->getCode(),
                    $e
                );
            }

            throw new FactoryException(
                sprintf('The writer configuration at index \'%s\' is invalid', $writerName)
            );
        }
    }

    /**
     * Add a collection of log processors resolved from the provided configuration.
     *
     * @param LaminasLogger $logger
     * @param array         $config
     *
     * @throws FactoryException If a processor cannot be created.
     */
    private function addProcessors(LaminasLogger $logger, array $config): void
    {
        foreach ($config as $processorName => $processorConfig) {
            try {
                if ($processorConfig instanceof ProcessorInterface) {
                    $logger->addProcessor($processorConfig);
                    continue;
                }

                if (is_string($processorName)) {
                    $logger->addProcessor($processorName, null, is_array($processorConfig) ? $processorConfig : []);
                    continue;
                }
            } catch (\Throwable $e) {
                throw new FactoryException(
                    sprintf('Failed to create processor at index \'%s\': %s', $processorName, $e->getMessage()),
                    $e->getCode(),
                    $e
                );
            }

            throw new FactoryException(
                sprintf('The processor configuration at index \'%s\' is invalid', $processorName)
            );
        }
    }
}
