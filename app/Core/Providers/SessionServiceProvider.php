<?php

namespace App\Core\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Session\Adapter\Stream;
use Phalcon\Session\Manager;

class SessionServiceProvider implements ServiceProviderInterface {

    protected ?string $name = 'session';

    public function register(DiInterface $di) : void {
        $handler = new Stream([
            'savePath' => app()->getRootPath('tmp/session'),
        ]);

        $di->set($this->name, function () use ($handler) {
            $session = new Manager();

            $session->setAdapter($handler)->start();

            return $session;
        });
    }

}