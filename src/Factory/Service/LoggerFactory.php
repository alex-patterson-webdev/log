<?php

namespace Arp\Log\Factory\Service;

use Arp\Log\Service\Logger;
use Arp\Stdlib\Exception\ServiceNotCreatedException;
use Arp\Stdlib\Factory\AbstractServiceFactory;
use Interop\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

/**
 * LoggerFactory
 *
 * Default factory class to create a new LoggerInterface from configuration options.
 *
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\Log\Factory\Service
 */
class LoggerFactory extends AbstractServiceFactory
{
    /**
     * $defaultClassName
     *
     * @var string
     */
    protected $defaultClassName = Logger::class;

    /**
     * $_factoryConfigKey
     *
     * @var string
     */
    protected $_factoryConfigKey = 'loggers';

    /**
     * create
     *
     * @param ContainerInterface $container     The dependency injection container.
     * @param string             $requestedName The name of the service requested to the container.
     * @param array              $config        The optional factory configuration options.
     * @param string|null        $className     The name of the class that is being created.
     *
     * @return LoggerInterface
     *
     * @throws ServiceNotCreatedException  If the service cannot be created.
     */
    public function create(ContainerInterface $container, $requestedName, array $config = [], $className = null)
    {
        $logger = isset($config['zend_logger']) ? $config['zend_logger'] : false;

        if (empty($logger)) {

        }
    }


}