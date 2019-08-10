<?php

namespace Arp\Log\Factory\Service;

use Arp\Stdlib\Exception\ServiceNotCreatedException;
use Arp\Stdlib\Factory\AbstractServiceFactory;
use Interop\Container\ContainerInterface;
use Zend\Log\Processor\ProcessorInterface;
use Zend\Log\ProcessorPluginManager;
use Zend\Log\Writer\WriterInterface;
use Zend\Log\WriterPluginManager;
use Zend\Log\Logger;

/**
 * ZendLoggerFactory
 *
 * Create a new Zend logger using provided configuration options.
 *
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\Log\Factory\Service
 */
class ZendLoggerFactory extends AbstractServiceFactory
{
    /**
     * $_factoryConfigKey
     *
     * @var string
     */
    protected $_factoryConfigKey = 'loggers';

    /**
     * $defaultClassName
     *
     * @var string
     */
    protected $defaultClassName = Logger::class;

    /**
     * create
     *
     * Create a new Zend Framework logger instance.
     *
     * @param ContainerInterface $container     The dependency injection container.
     * @param string             $requestedName The name of the service requested to the container.
     * @param array              $config        The optional factory configuration options.
     * @param string|null        $className     The name of the class that is being created.
     *
     * @return Logger
     *
     * @throws ServiceNotCreatedException  If the service cannot be created.
     */
    public function create(ContainerInterface $container, $requestedName, array $config = [], $className = null)
    {
        $defaultOptions = [
            'exceptionhandler'             => false,
            'errorhandler'                 => false,
            'fatal_error_shutdownfunction' => false,
        ];

        $processPluginManager = isset($config['processor_plugin_manager']) ? $config['processor_plugin_manager'] : 'LogProcessorManager';
        $writerPluginManager  = isset($config['writer_plugin_manager'])    ? $config['writer_plugin_manager']    : 'LogWriterManager';

        $writers    = isset($config['writers'])    ? $config['writers']    : [];
        $processors = isset($config['processors']) ? $config['processors'] : [];

        /** @var WriterPluginManager $writerPluginManager */
        $writerPluginManager  = $this->getService(
            $container,
            $writerPluginManager,
            WriterPluginManager::class
        );

        /** @var ProcessorPluginManager $processPluginManager */
        $processPluginManager = $this->getService(
            $container,
            $processPluginManager,
            ProcessorPluginManager::class
        );

        $options = [
            'writer_plugin_manager'    => $writerPluginManager,
            'processor_plugin_manager' => $processPluginManager,
            'writers'                  => $this->getLogWriters($writerPluginManager, $writers),
            'processors'               => $this->getLogProcessors($processPluginManager, $processors),
        ];

        /** @var Logger $logger */
        $logger = new $className(array_replace($defaultOptions, $options));

        return $logger;
    }

    /**
     * getLogWriters
     *
     * Return a collection of LogWriterInterface instances based on provided configuration.
     *
     * @param ContainerInterface $container       The dependency injection container.
     * @param array              $configurations  The writer configurations.
     *
     * @return WriterInterface[]
     *
     * @throws ServiceNotCreatedException If the config writers cannot be created.
     */
    protected function getLogWriters(ContainerInterface $container, array $configurations) : array
    {
        $writers = [];

        foreach($configurations as $index => $config) {

            if ($config instanceof WriterInterface) {
                $writers[] = $config;
            }
            elseif (! is_array($config)) {
                continue;
            }
            elseif (! isset($config['name'])) {

                throw new ServiceNotCreatedException(sprintf(
                    'The log writer at index \'%d\' is missing the required \'name\' configuration option.',
                    $index
                ));
            }

            $writers[] = $this->getService($container, $config['name'], WriterInterface::class);
        }

        return $writers;
    }

    /**
     * getLogProcessors
     *
     * Return a collection of ProcessorInterface instances based on provided configuration.
     *
     * @param ContainerInterface $container       The dependency injection container.
     * @param array              $configurations  The processor configurations.
     *
     * @return ProcessorInterface[]
     *
     * @throws ServiceNotCreatedException  If the log processors cannot be created.
     */
    protected function getLogProcessors(ContainerInterface $container, array $configurations) : array
    {
        $processors = [];

        foreach($configurations as $index => $config) {

            if ($config instanceof ProcessorInterface) {
                $processors[] = $config;
            }
            elseif (! is_array($config)) {
                continue;
            }
            elseif (! isset($config['name'])) {

                throw new ServiceNotCreatedException(sprintf(
                    'The log processor at index \'%d\' is missing the required \'name\' configuration option.',
                    $index
                ));
            }

            $processors[] = $this->getService($container, $config['name'], ProcessorInterface::class);
        }

        return $processors;
    }

}