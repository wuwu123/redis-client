<?php

class Test
{
    public $redisConnect = false;

    /**
     * Test constructor.
     *
     * @throws \wjredis\Exception
     */
    function __construct()
    {
        require "../vendor/autoload.php";
        $this->redisConnect = new \wjredis\RedisClient([
            "hostname" => "",
            "port" => "6379",
            "password" => "",
            "select" => "1",
            "fun_max_retry" => "1",
            "connect_max_retry" => "3",
            "retry_ime" => "1",
        ]);
    }
}

$model = new Test();
$model->redisConnect->set("ffff", 444455 , 3);
var_dump($model->redisConnect->get("ffff"));

