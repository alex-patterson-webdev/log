<?php

namespace ArpTest\Log\phpunit\Factory;

use Arp\Factory\Exception\FactoryException;
use Arp\Factory\FactoryInterface;
use Arp\Log\Factory\LoggerFactory;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * LoggerFactoryTest
 *
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package ArpTest\Log\phpunit\Factory
 */
final class LoggerFactoryTest extends TestCase
{
    /**
     * Assert that the factory implements FactoryInterface.
     *
     * @covers \Arp\Log\Factory\LoggerFactory
     */
    public function testImplementsFactoryInterface() : void
    {
        $factory = new LoggerFactory();

        $this->assertInstanceOf(FactoryInterface::class, $factory);
    }

    /**
     * Assert that a FactoryException is thrown if providing a invalid class_name configuration option to create().
     *
     * @throws FactoryException
     *
     * @covers \Arp\Log\Factory\LoggerFactory::create
     */
    public function testCreateWillThrowFactoryExceptionIfClassNameIsNotOfTypeLoggerInterface() : void
    {
        $factory = new LoggerFactory();

        $className = \stdClass::class;
        $config = [
            'class_name' => $className,
        ];

        $this->expectException(FactoryException::class);
        $this->expectExceptionMessage(sprintf(
            'The \'class_name\' option must be a class that implements \'%s\'; \'%s\' provided in \'%s\'',
            LoggerInterface::class,
            is_string($className) ? $className : gettype($className),
            LoggerFactory::class
        ));

        $factory->create($config);
    }

    /**
     * Assert that a FactoryException is thrown if calling create with an empty 'logger' option.
     *
     * @throws FactoryException
     *
     * @covers \Arp\Log\Factory\LoggerFactory::create
     */
    public function testCreateWillThrowFactoryExceptionIfTheLoggerOptionIsEmpty() : void
    {
        $factory = new LoggerFactory();

        $config = [
            'logger' => '',
        ];

        $this->expectException(FactoryException::class);
        $this->expectExceptionMessage(sprintf(
            'The required \'logger\' configuration option is missing or invalid in \'%s\'',
            LoggerFactory::class
        ));

        $factory->create($config);
    }

    /**
     * Assert that a FactoryException is thrown if the 'logger' is invalid.
     *
     * @param mixed $logger The logger value to test.
     *
     * @throws FactoryException
     *
     * @dataProvider getCreateWillThrowFactoryExceptionIfTheLoggerOptionIsInvalidData
     *
     * @covers \Arp\Log\Factory\LoggerFactory::create
     * @covers \Arp\Log\Factory\LoggerFactory::getLogger
     */
    public function testCreateWillThrowFactoryExceptionIfTheLoggerOptionIsInvalid($logger) : void
    {
        $factory = new LoggerFactory();

        $config = [
            'logger' => $logger,
        ];

        if (is_string($logger)) {
            $exceptionMessage = sprintf(
                'The \'logger\' option must be a class that implements \'%s\'; \'%s\' provided in \'%s\'',
                LoggerInterface::class,
                $logger,
                LoggerFactory::class
            );
        } else {
            $exceptionMessage = sprintf(
                'The \'logger\' option must be an object that implements \'%s\'; \'%s\' provided in \'%s\'',
                LoggerInterface::class,
                is_object($logger) ? get_class($logger) : gettype($logger),
                LoggerFactory::class
            );
        }

        $this->expectException(FactoryException::class);
        $this->expectExceptionMessage($exceptionMessage);

        $factory->create($config);
    }

    /**
     * @return array
     *
     * @throws \Exception
     */
    public function getCreateWillThrowFactoryExceptionIfTheLoggerOptionIsInvalidData() : array
    {
        return [
            [true],
            [\stdClass::class],
            [new \DateTime()],
        ];
    }

    /**
     * Assert that a valid logger instance is returned from create() based on the provided $config options.
     *
     * @param array $config  The optional configuration options.
     *
     * @throws FactoryException
     *
     * @dataProvider getCreateData
     *
     * @covers \Arp\Log\Factory\LoggerFactory::create
     * @covers \Arp\Log\Factory\LoggerFactory::getLogger
     */
    public function testCreate(array $config = []) : void
    {
        $factory = new LoggerFactory();

        $logger = $factory->create($config);

        $this->assertInstanceOf(LoggerInterface::class, $logger);
    }

    /**
     * @return array
     */
    public function getCreateData() : array
    {
        return [
            [
                []
            ],

            [
                [
                    'logger' => NullLogger::class,
                ]
            ],

            [
                [
                    'logger' => $this->getMockForAbstractClass(LoggerInterface::class),
                ]
            ]
        ];
    }
}