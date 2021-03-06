<?php

declare(strict_types=1);

namespace Arp\Log\Factory\Writer;

use Arp\Factory\Exception\FactoryException;
use Arp\Factory\FactoryInterface;
use Laminas\Log\Exception\ExceptionInterface;
use Laminas\Log\Writer\Stream as StreamWriter;

/**
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\Log\Factory\Writer
 */
class StreamWriterFactory implements FactoryInterface
{
    /**
     * Create a new stream writer based on the provided configuration options.
     *
     * @param array $config
     *
     * @return StreamWriter
     *
     * @throws FactoryException If the writer cannot be created
     */
    public function create(array $config = []): StreamWriter
    {
        $stream = $config['stream'] ?? null;

        if (null === $stream) {
            throw new FactoryException(
                sprintf('The required \'stream\' configuration option is missing in \'%s\'', static::class)
            );
        }

        $streamConfig = [
            'stream'        => $stream,
            'log_separator' => $config['log_separator'] ?? null,
            'mode'          => $config['mode'] ?? null,
            'chmod'         => $config['chmod'] ?? null,
        ];

        try {
            return new StreamWriter($streamConfig);
        } catch (ExceptionInterface $e) {
            throw new FactoryException(
                sprintf(
                    'An error occurred while trying to create the log stream writer: %s',
                    $e->getMessage()
                ),
                $e->getCode(),
                $e
            );
        }
    }
}
