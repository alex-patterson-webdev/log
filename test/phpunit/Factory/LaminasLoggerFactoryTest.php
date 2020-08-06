<?php

declare(strict_types=1);

namespace ArpTest\Log\Factory;

use Arp\Factory\FactoryInterface;
use Arp\Log\Factory\LaminasLoggerFactory;
use PHPUnit\Framework\TestCase;

/**
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package ArpTest\Log\Factory
 */
final class LaminasLoggerFactoryTest extends TestCase
{
    /**
     * Assert that the factory implements FactoryInterface.
     *
     * @covers \Arp\Log\Factory\LaminasLoggerFactory
     */
    public function testImplementsFactoryInterface(): void
    {
        $factory = new LaminasLoggerFactory();

        $this->assertInstanceOf(FactoryInterface::class, $factory);
    }
}
