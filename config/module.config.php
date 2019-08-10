<?php

namespace Arp\Log;

use Zend\Log\ProcessorPluginManagerFactory;
use Zend\Log\WriterPluginManagerFactory;

return [
    'arp' => [
        'loggers' => [

        ],
    ],

    'service_manager' => [
        'factories' => [
            'LogWriterManager'    => WriterPluginManagerFactory::class,
            'LogProcessorManager' => ProcessorPluginManagerFactory::class,
        ],
    ],


];