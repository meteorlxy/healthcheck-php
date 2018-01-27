<?php
 
namespace Xjtuana\HealthCheck;

/**
 * Health Check Result.
 * 
 * @package    Health Check
 *
 * @author     xczh <xczh.me@foxmail.com>
 * @author     meteorlxy <meteor.lxy@foxmail.com>
 *
 * @copyright  Copyright (C) 2018 XJTUANA. All Rights Reserved.
 */
class Result {
    
    /**
     * The data of healthcheck result.
     * 
     * @var array
     */
    protected $data;
    
    /**
     * Create a new healthcheck result instance.
     *
     * @param  string   $checkName
     * @param  string   $addr
     * @param  int      $port
     * @param  bool     $ok
     * @param  string   $err
     * 
     * @return void
     */
    public function __construct(string $checkName, string $addr, int $port = 0, bool $ok = true, string $err = '') {
        $this->data = [
            'checkName' => $checkName,
            'addr' => $addr,
            'port' => $port,
            'ok' => $ok,
            'err' => $err,
            'ts' => time(),
        ];
    }
    
    /**
     * Get the json string of the result.
     * 
     * @return string
     */
    public function json() {
        return json_encode($this->data);
    }
    
    /**
     * Override the __toString method.
     * 
     * @return string
     */
    public function __toString() {
        return $this->json();
    }
    
    /**
     * Get the attribute of the reulst.
     * 
     * @return mixed
     */
    function __get($name) {
        return array_key_exists($name, $this->data) ? $this->data[$name] : null;
    }
}
