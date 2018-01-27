<?php

namespace Xjtuana\HealthCheck;

/**
 * Interface of Health Check.
 *
 * @package    Health Check
 *
 * @author     xczh <xczh.me@foxmail.com>
 * @author     meteorlxy <meteor.lxy@foxmail.com>
 *
 * @copyright  Copyright (C) 2018 XJTUANA. All Rights Reserved.
 */
interface CheckInterface {
    
    /**
     * Check the health of the service with cache.
     * 
     * @param  string   $addr       host address
     * @param  int      $port       port number
     * @param  int      $timeout    check timeout
     * 
     * @return \Xjtuana\HealthCheck\Result
     */
    public function check(string $addr, int $port, int $timeout): Result;
    
    /**
     * Check the health of the service at once (without cache).
     * 
     * @param  string   $addr       host address
     * @param  int      $port       port number
     * @param  int      $timeout    check timeout
     * 
     * @return \Xjtuana\HealthCheck\Result
     */
    public function checkAtOnce(string $addr, int $port, int $timeout): Result;
}
