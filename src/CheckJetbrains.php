<?php
 
namespace Xjtuana\HealthCheck;

use GuzzleHttp\Client;

/**
 * Jetbrains Health Check.
 *
 * @package    Health Check
 *
 * @author     xczh <xczh.me@foxmail.com>
 * @author     meteorlxy <meteor.lxy@foxmail.com>
 *
 * @copyright  Copyright (C) 2018 XJTUANA. All Rights Reserved.
 */
class CheckJetbrains extends Check implements CheckInterface {
    
    /**
     * Instance of Http Client.
     * 
     * @var \GuzzleHttp\Client
     */
    protected $http;
    
    /**
     * Get the instance of Http Client.
     * 
     * @return \GuzzleHttp\Client
     */
    protected function http() {
        if (! $this->http instanceof Client) {
            $this->http = new Client();
        }
        return $this->http;
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
    public function checkAtOnce(string $addr, int $port = 0, int $timeout = 3): Result {
        $res = $this->http()->get(0 === strpos($addr, 'http') ? $addr : 'http://' . $addr, [
            'timeout' => $timeout,
            'connect_timeout' => $timeout,
        ])->getBody()->getContents();
        $ok = true;
        $err = '';
        if (false === strpos($res, 'Jetbrains License Server')) {
            $ok = false;
            $err = 'response body not contain substr, body: ' . $res;
        }
        return new Result(static::class, $addr, $port, $ok, $err);
    }
}
