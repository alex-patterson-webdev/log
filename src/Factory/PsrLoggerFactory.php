<?php

declare(strict_types=1);

namespace Arp\Log\Factory;

use Arp\Factory\Exception\FactoryException;
use Laminas\Log\PsrLoggerAdapter;

/**
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\Log\Factory
 */
class PsrLoggerFactory extends AbstractLoggerFactory
{
    /**
     * Create a new service.
     *
     * @param array $config The optional factory configuration options.
     *
     * @return mixed
     *
     * @throws FactoryException If the service cannot be created.
     */
    public function create(array $config = [])
    {
        return new PsrLoggerAdapter($this->createLaminasLogger($config));
    }
}
