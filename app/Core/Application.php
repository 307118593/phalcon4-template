<?php

namespace App\Core;

use App\Core\Providers\ApcuServiceProvider;
use App\Core\Providers\ConfigServiceProvider;
use App\Core\Providers\CryptServiceProvider;
use App\Core\Providers\DatabaseServiceProvider;
use App\Core\Providers\ExceptionServiceProvider;
use App\Core\Providers\LoggerServiceProvider;
use App\Core\Providers\ModelsMetadataServiceProvider;
use App\Core\Providers\RouteServiceProvider;
use App\Core\Providers\SessionServiceProvider;
use App\Core\Providers\ViewServiceProvider;
use Phalcon\Di;
use Phalcon\Di\DiInterface;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application as MvcApplication;

class Application {

    protected string $rootPath;

    protected DiInterface $di;

    protected MvcApplication $app;

    public function __construct(string $root) {
        $this->di = new FactoryDefault();

        Di::reset();
        Di::setDefault($this->di);

        $this->app = new MvcApplication($this->di);

        $this->rootPath = $root;

        $this->di->setShared('app', $this);

        $this->bindProviders();
    }

    /**
     * @return string
     */
    public function build() : string {
        /** @var \Phalcon\Http\ResponseInterface $response */
        $response = $this->app->handle($_SERVER['REQUEST_URI']);

        $response->setHeader('Content-Type','application/json');
        $response->setHeader('Content-Length',strlen($response->getContent()));

        return $response->send()->getContent();
    }

    /**
     * @param null|string $path
     *
     * @return string
     */
    public function getRootPath(?string $path = "") : string {
        return $this->rootPath . '/' . $path;
    }

    /**
     * @param null|string $environment
     *
     * @return bool|mixed
     */
    public function environment(?string $environment = NULL) {
        if($environment) return config('env') === $environment;

        return config('env');
    }

    private function bindProviders() : void {
        $this->di->register(new ConfigServiceProvider());
        $this->di->register(new ApcuServiceProvider());
        $this->di->register(new LoggerServiceProvider());
        $this->di->register(new ViewServiceProvider());
        $this->di->register(new RouteServiceProvider());
        $this->di->register(new ExceptionServiceProvider());
        $this->di->register(new CryptServiceProvider());
        $this->di->register(new DatabaseServiceProvider());
        $this->di->register(new ModelsMetadataServiceProvider());
        $this->di->register(new SessionServiceProvider());
    }

}