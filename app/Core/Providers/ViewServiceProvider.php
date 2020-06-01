<?php

namespace App\Core\Providers;

use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Di\DiInterface;
use Phalcon\Mvc\View;

class ViewServiceProvider implements ServiceProviderInterface {

    protected string $name = 'view';

    public function register(DiInterface $di) : void {
        $di->setShared($this->name, function () {
            $view = new View();

            $view->setViewsDir(app()->getRootPath('views'));

            return $view;
        });
    }
}