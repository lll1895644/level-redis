<?php
require __DIR__ . '/src/Server.php';
$serv = new LevelRedis\Server(require __DIR__ . '/configs/leveldb.php');
$serv->run(require __DIR__ . '/configs/server.php');