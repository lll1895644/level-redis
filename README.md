# level-redis
使用磁盘存储数的Redis，基于leveldb+swoole实现。

* Redis是一个非常优秀的nosql存储，是完全基于内存的，非热点数据存在Redis中会浪费大量内存资源
* level-redis基于磁盘存储数据，协议完全兼容Redis，可以存储大量数据而且不占太大内存

依赖
----
* leveldb: <https://github.com/google/leveldb>
* php-leveldb: <https://github.com/reeze/php-leveldb>
* swoole: <https://github.com/swoole/swoole-src> (1.9.0+)

安装
----
安装swoole和leveldb扩展，并下载源码

```shell
pecl install swoole 
pecl install leveldb
```
运行
----
```shell
php server.php
```

测试
----
```shell
#redis服务器
htf@htf-All-Series:~/workspace/php/level-redis$ redis-cli 
127.0.0.1:6379> set hello swoole
OK
127.0.0.1:6379> get hello
"swoole"
127.0.0.1:6379> del hello
(integer) 1
127.0.0.1:6379> get hello
(nil)
127.0.0.1:6379> 
#level-redis服务器
htf@htf-All-Series:~/workspace/php/level-redis$ redis-cli -p 9501
127.0.0.1:9501> set hello swoole
OK
127.0.0.1:9501> get hello
"swoole"
127.0.0.1:9501> del hello
(integer) 1
127.0.0.1:9501> get hello
(nil)
127.0.0.1:9501>
```
