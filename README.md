# Arp\Log

## About

`Arp\Log` is a component for general purpose logging based on the [PSR-3 LoggerInterface](https://www.php-fig.org/psr/psr-3/) using 
[Zend Framework 3](https://github.com/zendframework) components.

The module provides the following features :

- A PSR-3 wrapper to a [`Zend\Log\Logger`](https://docs.zendframework.com/zend-log/).
- Write to multiple `WriterInterface` streams for flexible log storage options.
- Provide processing and filtering of logging information.
- Configuration based creation of loggers; no need to write any code.
- Extendable factory classes for custom logger implementations.

## Installation

Installation via [composer](https://getcomposer.org/).

    php composer.phar require alex-patterson-webdev/log ^1
    
## Installation as a Zend Framework 3 module

Example module and `ServiceManager` configuration can be found in `config/example.config.php.dist`. 

You will also need to ensure that the `Arp\Log` namespace is added to the application’s `config/modules.config.php` so it 
will bootstrap the module.

    // config/modules.config.php
    return [
        'Arp\\Log', // Added
        'Application',
    ];

### Manually creating Loggers

There is not need to use Zend Framework in order to create and use the Logger. If you have services registered in a
dependency injection container implementing `Interop\Container\ContainerInterface` you can use the bundled factory classes
to construct a new logger; passing in the same configuration as `$factoryConfig`.

For example :

    use \Arp\Log\Service\Logger;
    use \Arp\Log\Factory\Service\LoggerFactory;

    $factory = new LoggerFactory;
    
    $factoryConfig = 
        // 'class_name' => Logger::class,
        'config' => [
            'writers' => [
                [
                    'name'    => 'MyFileWriter',
                    'options' => [],
                ],
            ],
        ],
    ];
    
    /** @var Logger **/
    $logger = $factory->__invoke($container, 'MyLogger', $factoryConfig);

    