<?php

namespace Arp\Log\Service;

use Psr\Log\LoggerInterface;

/**
 * LoggerAwareTrait
 *
 * Trait used to implement the LoggerAwareInterface.
 *
 * @package Arp\Log\Service
 */
trait LoggerAwareTrait
{
    /**
     * $logger
     *
     * @var LoggerInterface|null
     */
    protected $logger;

    /**
     * hasLogger
     *
     * Check if the logger has been defined.
     *
     * @return bool
     */
    public function hasLogger() : bool
    {
        return isset($this->logger);
    }

    /**
     * getLogger
     *
     * Return the logger instance.
     *
     * @return LoggerInterface|null
     */
    public function getLogger() : ?LoggerInterface
    {
        return $this->logger;
    }

    /**
     * setLogger
     *
     * Set the logger instance.
     *
     * @param LoggerInterface|null $logger
     *
     * @return mixed
     */
    public function setLogger(LoggerInterface $logger = null)
    {
        $this->logger = $logger;
    }

}