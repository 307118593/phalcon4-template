<?php

namespace App\Core;

use App\Core\Providers\ConfigServiceProvider;
use App\Core\Providers\DatabaseServiceProvider;
use App\Core\Providers\ExceptionServiceProvider;
use App\Core\Providers\LoggerServiceProvider;
use App\Core\Providers\ModelsMetadataServiceProvider;
use Phalcon\Di;
use Phalcon\Di\DiInterface;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Micro;

class TestCase {

    protected string $rootPath;

    protected DiInterface $di;

    protected Micro $app;

    public function __construct(string $root) {
        $this->di = new FactoryDefault();

        Di::reset();
        Di::setDefault($this->di);

        $this->app = new Micro($this->di);

        $this->rootPath = $root;

        $this->di->setShared('app', $this);

        $this->bindProviders();
    }

    /**
     * @return string
     */
    public function build() : void {}

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
        $this->di->register(new LoggerServiceProvider());
        $this->di->register(new ExceptionServiceProvider());
        $this->di->register(new DatabaseServiceProvider());
        $this->di->register(new ModelsMetadataServiceProvider());
    }
}