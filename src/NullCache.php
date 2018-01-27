<?php
 
namespace Xjtuana\HealthCheck;

/**
 * Implementation of Health Check NullCache.
 * 
 * @package    Health Check
 *
 * @author     xczh <xczh.me@foxmail.com>
 * @author     meteorlxy <meteor.lxy@foxmail.com>
 *
 * @copyright  Copyright (C) 2018 XJTUANA. All Rights Reserved.
 */
class NullCache implements CacheInterface {

    /**
     * Get the value of the key from cache.
     * 
     * @param  string  $key
     * 
     * @return mixed
     */
    public function get(string $key) {
        return null;
    }
    
    /**
     * Get the value of the key from cache.
     * 
     * @param  string  $key
     * @param  mixed   $value
     * @param  int     $ttl    expiration of the cache
     * 
     * @return bool
     */
    public function set(string $key, $value, int $ttl = 0): bool {
        return true;
    }
}
