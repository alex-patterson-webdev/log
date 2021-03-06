<?php

declare(strict_types=1);

namespace Arp\Log\Factory;

use Arp\Factory\FactoryInterface;
use Psr\Log\NullLogger;

/**
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\Log\Factory
 */
final class NullLoggerFactory implements FactoryInterface
{
    /**
     * Create a PSR-3 compatible logger that performs no operations or writes (useful for testing or a default).
     *
     * @param array $config
     *
     * @return NullLogger
     */
    public function create(array $config = []): NullLogger
    {
        return new NullLogger();
    }
}
