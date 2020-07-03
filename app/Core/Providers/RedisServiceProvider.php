<?php

namespace App\Core\Providers;

use Phalcon\Cache\Adapter\Redis;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Storage\SerializerFactory;

class RedisServiceProvider implements ServiceProviderInterface {

    protected string $name = 'redis';

    public function register(DiInterface $di) : void {
        di()->setShared($this->name, function () {
            $serializerFactory = new SerializerFactory();

            $options = [
                'lifetime' => 7200,
                'host'     => config('redis.host'),
                'port'     => config('redis.port'),
                'index'    => 1,
                'charset'  => 'utf8',
                'statsKey' => '_PHCR',
                'prefix'   => config('appName') . '_cache',
            ];

            return new Redis($serializerFactory, $options);
        });
    }

}