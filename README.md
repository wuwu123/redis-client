php redis 链接 和 失败重试

实例

```php

$model =  new \wjredis\RedisClient([
                     "hostname" => "",
                     "port" => "6379",
                     "password" => "",
                     "select" => "1",
                     "fun_max_retry" => "1",
                     "connect_max_retry" => "3",
                     "retry_ime" => "1",
                 ]);
$model->redisConnect->set("ffff", 444455 , 3);
var_dump($model->redisConnect->get("ffff"));

```

```text

wujie/redis-client

```