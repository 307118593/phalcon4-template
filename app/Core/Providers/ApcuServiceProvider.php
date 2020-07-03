<?php

namespace App\Core\Providers;

use Phalcon\Cache\Adapter\Apcu;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Storage\SerializerFactory;

class ApcuServiceProvider implements ServiceProviderInterface {

    protected string $name = 'apcu';

    public function register(DiInterface $di) : void {
        di()->setShared($this->name, function () {
            $serializerFactory = new SerializerFactory();

            $options = [
                'lifetime' => 7200,
                "prefix"   => config('appName') . "_cache_"
            ];

            return new Apcu($serializerFactory, $options);
        });
    }

}