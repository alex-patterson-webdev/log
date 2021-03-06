<?php

declare(strict_types=1);

namespace ArpTest\Log\Factory;

use Arp\Factory\FactoryInterface;
use Arp\Log\Factory\PsrLoggerFactory;
use PHPUnit\Framework\TestCase;

/**
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package ArpTest\Log\Factory
 */
final class PsrLoggerFactoryTest extends TestCase
{
    /**
     * Assert that the factory implements FactoryInterface.
     *
     * @covers \Arp\Log\Factory\PsrLoggerFactory
     */
    public function testImplementsFactoryInterface(): void
    {
        $factory = new PsrLoggerFactory();

        $this->assertInstanceOf(FactoryInterface::class, $factory);
    }
}
