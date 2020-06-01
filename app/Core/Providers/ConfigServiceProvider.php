<?php

namespace App\Core\Providers;

use Phalcon\Config\Adapter\Yaml;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

class ConfigServiceProvider implements ServiceProviderInterface {

    protected string $name = 'config';

    public function register(DiInterface $di) : void {
        di()->setShared($this->name, function (){
            return new Yaml(app()->getRootPath('config.yml'), [
                "!appPath" => function($value) {
                    return app()->getRootPath($value);
                },
            ]);
        });
    }
}