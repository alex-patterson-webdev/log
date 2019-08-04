<?php

namespace Arp\Log\Service;

/**
 * LoggerAwareInterface
 *
 * @package Arp\\Log\Service
 */
interface LoggerAwareInterface
{
    /**
     * getLogger
     *
     * Return the logger instance.
     *
     * @return LoggerInterface
     */
    public function getLogger();

    /**
     * setLogger
     *
     * Set the logger instance.
     *
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger);

}