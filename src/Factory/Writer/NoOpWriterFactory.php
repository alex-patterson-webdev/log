<?php

declare(strict_types=1);

namespace Arp\Log\Factory\Writer;

use Arp\Factory\FactoryInterface;
use Laminas\Log\Writer\Noop;

/**
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\Log\Factory\Writer
 */
final class NoOpWriterFactory implements FactoryInterface
{
    /**
     * @param array $config
     *
     * @return Noop
     */
    public function create(array $config = []): Noop
    {
        return new Noop();
    }
}
