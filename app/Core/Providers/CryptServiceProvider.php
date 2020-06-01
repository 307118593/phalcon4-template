<?php

namespace App\Core\Providers;

use Phalcon\Crypt;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

class CryptServiceProvider implements ServiceProviderInterface {

    protected string $name = 'crypt';

    public function register(DiInterface $di) : void {
        di()->set($this->name, function () {
            $crypt = new Crypt();

            $crypt->setCipher('AES-256-CBC');
            $crypt->setKey(config('app-key'));

            return $crypt;
        });
    }
}