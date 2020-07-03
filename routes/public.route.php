<?php

/**
 * This routes will be accessible for any
 * authorized and non-authorized requests
 */

/**
 * @var $router \Phalcon\Mvc\Router
 */

$router->setDefaultNamespace('App\Example\Controllers');

$router->addGet('/example', 'Example::example');

$router->addGet('/example-model', 'Example::exampleModel');
