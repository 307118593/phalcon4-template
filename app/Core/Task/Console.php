<?php

namespace App\Core\Task;

use App\Core\Providers\ConfigServiceProvider;
use App\Core\Providers\CryptServiceProvider;
use App\Core\Providers\DatabaseServiceProvider;
use App\Core\Providers\ExceptionServiceProvider;
use App\Core\Providers\LoggerServiceProvider;
use App\Core\Providers\ModelsMetadataServiceProvider;
use App\Core\Providers\RouteServiceProvider;
use App\Core\Providers\SessionServiceProvider;
use App\Core\Providers\ViewServiceProvider;
use Phalcon\Cli\Console as ConsoleApplication;
use Phalcon\Di;
use Phalcon\Di\DiInterface;
use Phalcon\Di\FactoryDefault\Cli;
use Phalcon\Mvc\Micro;

class Console {

    protected string $rootPath;

    protected DiInterface $di;

    protected ConsoleApplication $app;

    public function __construct(string $root) {
        $this->di = new Cli();

        Di::reset();
        Di::setDefault($this->di);

        $this->app = new ConsoleApplication($this->di);

        $this->rootPath = $root;

        $this->di->setShared('app', $this);

        $this->bindProviders();
    }

    /**
     * @param array $arguments
     *
     * @return void
     */
    public function build(array $arguments) : void {
        $this->app->handle($arguments);
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
        $this->di->register(new LoggerServiceProvider());
        $this->di->register(new ExceptionServiceProvider());
        $this->di->register(new CryptServiceProvider());
        $this->di->register(new DatabaseServiceProvider());
        $this->di->register(new ModelsMetadataServiceProvider());
        $this->di->register(new SessionServiceProvider());
    }
}