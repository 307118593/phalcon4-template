<?php

namespace App\Core\Providers;

use Phalcon\Config\Adapter\Yaml;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Mvc\Model\Metadata\Memory;

class ModelsMetadataServiceProvider implements ServiceProviderInterface {

    protected string $name = 'modelsMetadata';

    public function register(DiInterface $di) : void {
        di()->set($this->name, function (){
            return new Memory([
                "lifetime" => app()->environment('production') ? 60 * 60 * 24 : 10, /** 24 hours for production, 10 second for development */
                "prefix"   => app()->environment().'_mmd' /** production_mmd, samir_local_mmd, development_mmd */
            ]);
        });
    }
}