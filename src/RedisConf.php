<?php
/**
 * Created by PhpStorm.
 * User: wujie
 * Date: 2018/11/19
 * Time: 14:58
 */

namespace wjredis;


class RedisConf
{
    private $hostname;
    private $port = 6379;
    private $password = "";
    private $select = 0;
    private $timeOut = 2;

    /**
     * @var int 函数最大重试次数
     */
    private $funMaxRetry = 1;

    /**
     * @var int 链接最大重试次数
     */
    private $connectMaxRetry = 1;

    /**
     * @var int 重试等待时间
     */
    private $retryTime = 0;

    /**
     * @return int
     * @desc
     */
    public function getTimeOut(): int
    {
        return $this->timeOut;
    }

    /**
     * @param int $timeOut
     * @desc
     */
    public function setTimeOut(int $timeOut)
    {
        $this->timeOut = $timeOut;
    }


    /**
     * @return int
     * @desc
     */
    public function getFunMaxRetry(): int
    {
        return $this->funMaxRetry;
    }

    /**
     * @param int $funMaxRetry
     * @desc
     */
    public function setFunMaxRetry(int $funMaxRetry)
    {
        $this->funMaxRetry = $funMaxRetry;
    }

    /**
     * @return int
     * @desc
     */
    public function getConnectMaxRetry(): int
    {
        return $this->connectMaxRetry;
    }

    /**
     * @param int $connectMaxRetry
     * @desc
     */
    public function setConnectMaxRetry(int $connectMaxRetry)
    {
        $this->connectMaxRetry = $connectMaxRetry;
    }

    /**
     * @return int
     * @desc
     */
    public function getRetryTime(): int
    {
        return $this->retryTime;
    }

    /**
     * @param int $retryTime
     * @desc
     */
    public function setRetryTime(int $retryTime)
    {
        $this->retryTime = $retryTime;
    }

    /**
     * @return mixed
     * @desc
     */
    public function getHostname()
    {
        return $this->hostname;
    }

    /**
     * @param mixed $hostname
     * @desc
     */
    public function setHostname($hostname)
    {
        $this->hostname = $hostname;
    }

    /**
     * @return mixed
     * @desc
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param mixed $port
     * @desc
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return mixed
     * @desc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @desc
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     * @desc
     */
    public function getSelect()
    {
        return $this->select;
    }

    /**
     * @param mixed $select
     * @desc
     */
    public function setSelect($select)
    {
        $this->select = $select;
    }
}