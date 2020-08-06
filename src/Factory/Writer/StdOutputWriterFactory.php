<?php

declare(strict_types=1);

namespace Arp\Log\Factory\Writer;

use Arp\Factory\Exception\FactoryException;
use Arp\Factory\FactoryInterface;
use Laminas\Log\Writer\Stream;

/**
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\Log\Factory\Writer
 */
final class StdOutputWriterFactory implements FactoryInterface
{
    /**
     * Create a stream writer that renders content to the PHP STDOUT stream.
     *
     * @param array $config Optional configuration options for the stream
     *
     * @return Stream
     *
     * @throws FactoryException
     */
    public function create(array $config = []): Stream
    {
        $config = array_merge(
            ['stream' => STDOUT],
            $config
        );

        return (new StreamWriterFactory())->create($config);
    }
}
