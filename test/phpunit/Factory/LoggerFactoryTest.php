<?php

declare(strict_types=1);

namespace ArpTest\Log\Factory;

use Arp\Factory\FactoryInterface;
use Arp\Log\Factory\LoggerFactory;
use PHPUnit\Framework\TestCase;

/**
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package ArpTest\Log\Factory
 */
final class LoggerFactoryTest extends TestCase
{
    /**
     * Assert that the factory implements FactoryInterface.
     *
     * @covers \Arp\Log\Factory\LoggerFactory
     */
    public function testImplementsFactoryInterface(): void
    {
        $factory = new LoggerFactory();

        $this->assertInstanceOf(FactoryInterface::class, $factory);
    }
}
