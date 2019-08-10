<?php

namespace Arp\Log\Service;

use Psr\Log\LoggerInterface;

/**
 * LoggerAwareInterface
 *
 * @package Arp\\Log\Service
 */
interface LoggerAwareInterface
{
    /**
     * hasLogger
     *
     * Check if the logger has been defined.
     *
     * @return bool
     */
    public function hasLogger() : bool;

    /**
     * getLogger
     *
     * Return the logger instance.
     *
     * @return LoggerInterface|null
     */
    public function getLogger() : ?LoggerInterface;

    /**
     * setLogger
     *
     * Set the logger instance.
     *
     * @param LoggerInterface|null $logger
     *
     * @return mixed
     */
    public function setLogger(LoggerInterface $logger = null);

}