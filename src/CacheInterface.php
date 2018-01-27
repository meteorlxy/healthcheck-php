<?php

namespace Xjtuana\HealthCheck;

/**
 * Interface of Health Check Cache
 *
 * @package    Health Check
 *
 * @author     xczh <xczh.me@foxmail.com>
 * @author     meteorlxy <meteor.lxy@foxmail.com>
 *
 * @copyright  Copyright (C) 2018 XJTUANA. All Rights Reserved.
 */
interface CacheInterface {
    
    /**
     * Get the value of the key from cache.
     * 
     * @param  string  $key
     * 
     * @return mixed
     */
    public function get(string $key);
    
    /**
     * Get the value of the key from cache.
     * 
     * @param  string  $key
     * @param  mixed   $value
     * @param  int     $ttl    expiration of the cache
     * 
     * @return bool
     */
    public function set(string $key, $value, int $ttl): bool;
}
