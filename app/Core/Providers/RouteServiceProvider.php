<?php

namespace App\Core\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Mvc\Router;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class RouteServiceProvider implements ServiceProviderInterface {

    protected string $name = 'router';

    public function register(DiInterface $di) : void {
        di()->set($this->name, function () {
            $routerPath = app()->getRootPath('routes');

            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($routerPath));

            $routerFiles = [];

            foreach($files as $file) {
                if(!$file->isDir()) {
                    $routerFiles[] = $file->getPathname();
                }
            }

            // Create the router
            $router = new Router(FALSE);

            $router->removeExtraSlashes(TRUE);
            $router->notFound('App\Core\Controllers\Base::exit');

            foreach($routerFiles as $file) {
                include_once $file;
            }

            return $router;
        });
    }

}