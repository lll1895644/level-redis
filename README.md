# level-redis
使用磁盘存储数的Redis，基于leveldb+swoole实现。

* Redis是一个非常优秀的nosql存储，是完全基于内存的，非热点数据存在Redis中会浪费大量内存资源
* level-redis基于磁盘存储数据，协议完全兼容Redis，可以存储大量数据而且不占太大内存
