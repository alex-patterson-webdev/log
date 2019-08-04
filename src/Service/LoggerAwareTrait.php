<?php

namespace Arp\Log\Service;

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
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * getLogger
     *
     * Return the logger instance.
     *
     * @return LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * setLogger
     *
     * Set the logger instance.
     *
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

}