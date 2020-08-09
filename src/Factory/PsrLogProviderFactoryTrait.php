<?php

declare(strict_types=1);

namespace Arp\Log\Factory;

use Arp\Factory\Exception\FactoryException;
use Arp\Factory\FactoryInterface;
use Psr\Log\LoggerInterface;

/**
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\Log\Factory
 */
trait PsrLogProviderFactoryTrait
{
    use LogProviderFactoryTrait;

    /**
     * @var string
     */
    protected $defaultLoggerFactory = NullLoggerFactory::class;
}
