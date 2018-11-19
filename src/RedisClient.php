<?php
/**
 * Created by PhpStorm.
 * User: wujie
 * Date: 2018/11/19
 * Time: 14:21
 */

namespace wjredis;

class RedisClient extends RedisConf
{
    private $configArray;

    /**
     * @var \Redis
     */
    public $redis;

    /**
     * RedisClient constructor.
     *
     * @param $config
     * @throws Exception
     * @throws \Throwable
     */
    public function __construct($config)
    {
        $this->configArray = $config;
        $this->connect();
    }

    /**
     * @throws Exception
     */
    private function setConfig()
    {
        if (!$this->configArray) {
            throw new Exception("config invalid");
        }
        if (!is_array($this->configArray)) {
            throw new Exception("config 必须是数组");
        }
        if (!isset($this->configArray["hostname"]) || !$this->configArray["hostname"]) {
            throw new Exception("hostname invalid");
        }
        $this->setHostname($this->configArray["hostname"]);
        if (isset($this->configArray["port"]) && $this->configArray["port"]) {
            $this->setPort($this->configArray["port"]);
        }
        if (isset($this->configArray["select"]) && $this->configArray["select"]) {
            $this->setSelect($this->configArray["select"]);
        }
        if (isset($this->configArray["password"]) && $this->configArray["password"]) {
            $this->setPassword($this->configArray["password"]);
        }
        if (isset($this->configArray["timeout"]) && $this->configArray["timeout"]) {
            $this->setTimeOut($this->configArray["timeout"]);
        }

        if (isset($this->configArray["fun_max_retry"]) && $this->configArray["fun_max_retry"]) {
            $this->setFunMaxRetry($this->configArray["fun_max_retry"]);
        }
        if (isset($this->configArray["connect_max_retry"]) && $this->configArray["connect_max_retry"]) {
            $this->setConnectMaxRetry($this->configArray["connect_max_retry"]);
        }
        if (isset($this->configArray["retry_ime"]) && $this->configArray["retry_ime"]) {
            $this->setRetryTime($this->configArray["retry_ime"]);
        }
    }

    /**
     * @param bool $reload
     * @return \redis
     * @throws Exception
     * @throws \Throwable
     */
    private function connect($reload = false)
    {
        $this->setConfig();
        if ($reload || $this->redis == false) {
            $errorCount = 0;
            do {
                try {
                    $this->redis = new \redis();
                    $result = $this->redis->connect($this->getHostname(), $this->getPort(), $this->getTimeOut());
                    if (!$result) {
                        throw new Exception("redis: connect to server failed");
                    }
                    if ($this->getPassword() and !$this->redis->auth($this->getPassword())) {
                        throw new Exception("redis: auth failed");
                    }
                    if (false === $this->redis->select($this->getSelect())) {
                        throw new Exception("redis: db failed");
                    }
                    return $this->redis;
                } catch (\Throwable $e) {
                    $errorCount += 1;
                    $errorException = $e;
                }
            } while ($errorCount < $this->getConnectMaxRetry());
            if ($errorException) {
                throw $e;
            }
        }
        return $this->redis;
    }

    /**
     * @return \Redis
     */
    public function getConnect()
    {
        return $this->redis;
    }

    /**
     * @param $name
     * @param $args
     * @return mixed
     * @throws Exception
     * @throws \Throwable
     */
    public function __call($name, $args)
    {
        $retry_count = 0;
        do {
            try {
                return call_user_func_array([$this->redis, $name], $args);
            } catch (\Throwable $re) {
                $retry_count += 1;
                $this->connect(true);
                $exception = $re;
                if ($this->getRetryTime()) {
                    sleep($this->getRetryTime());
                }
            }
        } while ($retry_count < $this->getFunMaxRetry());
        if ($exception) {
            throw $exception;
        }
    }
}