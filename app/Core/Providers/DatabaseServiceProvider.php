<?php

namespace App\Core\Providers;

use App\Core\Exceptions\UnknownAdapterException;
use Phalcon\Config;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Db\Adapter\Pdo\Postgresql;
use Phalcon\Db\Adapter\Pdo\Sqlite;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

class DatabaseServiceProvider implements ServiceProviderInterface {

    protected string $name = 'db';

    const ADAPTERS = [
        'mysql'   => Mysql::class,
        'pgsql'   => Postgresql::class,
        'sqlite3' => Sqlite::class
    ];

    /**
     * @param \Phalcon\Di\DiInterface $di
     *
     * @throws \App\Core\Exceptions\UnknownAdapterException
     */
    public function register(DiInterface $di) : void {
        foreach(config('database') ?? [] as $key => $database) {
            if(!$adapter = self::ADAPTERS[$database->adapter])
                throw new UnknownAdapterException("'{$database->adapter}' has not been defined as DB adapter");

            $config  = $this->prepareConfig($key,$database);

            di()->set($this->name, fn() => new $adapter($config));
        }
    }

    /**
     * @param string          $key
     *
     * @param \Phalcon\Config $database
     *
     * @return array
     */
    private function prepareConfig(string $key, Config $database) : array {
        $databaseConfig = $database->toArray();
        unset($databaseConfig['adapter']); # prevents error: SQLSTATE[08006]

        switch (self::ADAPTERS[$database->get('adapter')]) {
            case Sqlite::class:
                $databaseConfig = ['dbname' => app()->getRootPath("database/database-{$key}.sqlite3")];
                break;
            case Postgresql::class:
                unset($databaseConfig['charset']); # prevents Psql unknown charset error
                break;
        }

        return $databaseConfig;
    }

}