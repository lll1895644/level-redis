<?php
namespace LevelRedis;

use Swoole\Redis\Server as RedisServer;

class Server
{
    protected $server;
    protected $leveldb;

    function __construct($config)
    {
        $this->leveldb = $leveldb = new \LevelDB($config['root'], $config['options'], $config['readoptions'],
            $config['writeoptions']);
        register_shutdown_function(function () use ($leveldb)
        {
            $leveldb->close();
        });
    }

    function Get($fd, $data)
    {
        $key = $data[0];
        $value = $this->leveldb->get($key);
        if ($value)
        {
            return RedisServer::format(RedisServer::STRING, $value);
        }
        else
        {
            return RedisServer::format(RedisServer::NIL);
        }
    }

    function Set($fd, $data)
    {
        $key = $data[0];
        $value = $data[1];
        if ($this->leveldb->set($key, $value))
        {
            return RedisServer::format(RedisServer::STATUS, "OK");
        }
        else
        {
            return RedisServer::format(RedisServer::ERROR, "leveldb error.");
        }
    }

    function Del($fd, $data)
    {
        $key = $data[0];
        if ($this->leveldb->delete($key))
        {
            return RedisServer::format(RedisServer::INT, 1);
        }
        else
        {
            return RedisServer::format(RedisServer::INT, 0);
        }
    }

    function run($config)
    {
        $server = new RedisServer($config['server']['host'], $config['server']['port'], SWOOLE_BASE);
        $server->set($config['setting']);

        $server->setHandler("Get", array($this, 'Get'));
        $server->setHandler("Set", array($this, 'Set'));
        $server->setHandler("Del", array($this, 'Del'));

        $this->server = $server;
        $this->server->start();
    }
}