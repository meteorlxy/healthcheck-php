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
     * Check the health of the service at once (without cache).
     * 
     * @param  string   $addr       host address
     * @param  int      $port       port number
     * @param  int      $timeout    check timeout
     * 
     * @return \Xjtuana\HealthCheck\Result
     */
    public function checkAtOnce(string $addr, int $port, int $timeout): Result {
        $http = new Client();
        $res = $http->get($addr, [
            'timeout' => $timeout,
            'connect_timeout' => $timeout,
        ]);
        $ok = true;
        $err = '';
        if (false === strpos($res->getBody()->getContents(), "Jetbrains License Server")) {
            $ok = false;
            $err = "response body not contain substr, body: " . $res[1];
        }
        return new Result(__CLASS__, $addr, $port, $ok, $err);
    }
}
