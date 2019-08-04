<?php

namespace Arp\Log\Service;

/**
 * Logger
 *
 * Custom logger for the Spectrum Application.
 *
 * @package Spectrum\Log\Service
 */
class Logger implements LoggerInterface
{

    /**
     * @param mixed  $level
     * @param string $message
     * @param array  $context
     */
    public function log($level, $message, array $context = array())
    {
        // TODO: Implement log() method.
    }

    /**
     * @param string $message
     * @param array  $context
     */
    public function emergency($message, array $context = array())
    {
        // TODO: Implement emergency() method.
    }

    /**
     * @param string $message
     * @param array  $context
     */
    public function alert($message, array $context = array())
    {
        // TODO: Implement alert() method.
    }

    /**
     * @param string $message
     * @param array  $context
     */
    public function critical($message, array $context = array())
    {
        // TODO: Implement critical() method.
    }

    /**
     * @param string $message
     * @param array  $context
     */
    public function error($message, array $context = array())
    {
        // TODO: Implement error() method.
    }

    /**
     * @param string $message
     * @param array  $context
     */
    public function warning($message, array $context = array())
    {
        // TODO: Implement warning() method.
    }

    /**
     * @param string $message
     * @param array  $context
     */
    public function notice($message, array $context = array())
    {
        // TODO: Implement notice() method.
    }

    /**
     * @param string $message
     * @param array  $context
     */
    public function info($message, array $context = array())
    {
        // TODO: Implement info() method.
    }

    /**
     * @param string $message
     * @param array  $context
     */
    public function debug($message, array $context = array())
    {
        // TODO: Implement debug() method.
    }



}