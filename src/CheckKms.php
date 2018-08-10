<?php
 
namespace Xjtuana\HealthCheck;

/**
 * KMS Health Check.
 * 
 * @package    Health Check
 *
 * @author     xczh <xczh.me@foxmail.com>
 *
 * @copyright  Copyright (C) 2018 XJTUANA. All Rights Reserved.
 */
class CheckKms extends Check implements CheckInterface {
    
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
        try {
            $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
            if (!$socket) {
                $errno = socket_last_error();
                throw new \Exception("socket create error:" . socket_strerror($errno), $errno);
            }
            socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => $timeout, 'usec' => 0));
            socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => $timeout, 'usec' => 0));
            $ok = @socket_connect($socket, $addr, $port);
            $err = "";
            if (!$ok) {
                $err = socket_strerror(socket_last_error());
            }
            socket_close($socket);
        } catch (\Exception $e) {
            $ok = false;
            $err = $e->getMessage();
        }
        return new Result(static::class, $addr, $port, $ok, $err);
    }
}
