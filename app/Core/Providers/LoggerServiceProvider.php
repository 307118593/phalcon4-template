<?php

namespace App\Core\Providers;

use Phalcon\Config\Adapter\Yaml;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Logger\Adapter\Stream;
use Phalcon\Logger\Formatter\Line;

class LoggerServiceProvider implements ServiceProviderInterface {

    protected string $name = 'logger';

    public function register(DiInterface $di) : void {
        di()->set($this->name, function () {
            $filename = trim(date('Y-m-d').'.log', '\\/');
            $path     = rtrim(app()->getRootPath('logs'), '\\/') . DIRECTORY_SEPARATOR;

            $formatter = new Line("[%date%] [%type%] %message%", "D j H:i:s");
            $logger    = new Stream($path . $filename);

            $logger->setFormatter($formatter);

            return $logger;
        });
    }
}