<?php
 
namespace Xjtuana\HealthCheck;

/**
 * Abstract Class of Health Check.
 * 
 * @package    Health Check
 *
 * @author     xczh <xczh.me@foxmail.com>
 * @author     meteorlxy <meteor.lxy@foxmail.com>
 *
 * @copyright  Copyright (C) 2018 XJTUANA. All Rights Reserved.
 */
abstract class Check implements CheckInterface {
    
    /**
     * Instance of CacheInterface.
     * 
     * @var \Xjtuana\HealthCheck\CacheInterface
     */
    protected $cache;
    
    /**
     * Get the cache instance used by the checker.
     * 
     * @return \Xjtuana\HealthCheck\CacheInterface
     */
    protected function cache() {
        if (! $this->cache instanceof CacheInterface) {
            $this->cache = new NullCache();
        }
        return $this->cache;
    }
    
    /**
     * Set the cache instance used by the checker.
     * 
     * @return $this
     */
    public function useCache(CacheInterface $cache) {
        $this->cache = $cache;
        return $this;
    }
    
    /**
     * Check the health of the service with cache.
     * 
     * @param  string   $addr       host address
     * @param  int      $port       port number
     * @param  int      $timeout    check timeout
     * 
     * @return \Xjtuana\HealthCheck\Result
     */
    final public function check(string $addr, int $port = 0, int $timeout = 3): Result {
        $key = sprintf("%s::%s:%d", static::class, $addr, $port);
        $result = $this->cache()->get($key) ?? $this->checkAtOnce($addr, $port, $timeout);
        if (false === $this->cache()->set($key, $result)) {
            throw new \Exception('set cache error: checker('.static::class.'), key('.$key.'), result('.$result.').');
        }
        return $result;
    }
    
    /**
     * Check the health of the service at once (without cache).
     * 
     * @param  string   $addr       host address
     * @param  int      $port       port number
     * @param  int      $timeout    check timeout
     * 
     * @return \Xjtuana\HealthCheck\Result
     */
    abstract public function checkAtOnce(string $addr, int $port, int $timeout): Result;
}
