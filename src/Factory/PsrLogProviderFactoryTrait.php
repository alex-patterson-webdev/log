<?php

declare(strict_types=1);

namespace Arp\Log\Factory;

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
    protected $defaultLoggerFactory = PsrLoggerFactory::class;
}
