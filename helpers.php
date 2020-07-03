<?php

if(!function_exists('di')) {
    /**
     * @return \Phalcon\Di\DiInterface
     */
    function di() : \Phalcon\Di\DiInterface {
        return \Phalcon\Di::getDefault();
    }
}

if(!function_exists('app')) {
    /**
     * @return \App\Core\Application|\App\Core\TestCase|\App\Core\Task\Console
     */
    function app() {
        return di()->getShared('app');
    }
}

if(!function_exists('prettyResponse')) {
    /**
     * @param            $data
     * @param            $message
     * @param            $status
     * @param            $code
     * @param null|array $trace
     *
     * @return string
     */
    function prettyResponse($data, $message, $status, $code, ?array $trace = NULL) : string {
        return json_encode([
            'status'  => $status,
            'code'    => (int) $code,
            'message' => $message,
            'data'    => $data,
            'rat'     => date('c'),
            'trace'   => $trace,
        ], JSON_FORCE_OBJECT | JSON_PRETTY_PRINT);
    }
}

if(!function_exists('config')) {
    /**
     * @param string $value
     *
     * @return mixed
     */
    function config(string $value) {

        $config = di()->get('config');

        $parts = explode('.', $value);

        foreach($parts as $part) {
            $config = $config->$part;
        }

        return $config;
    }
}

if(!function_exists('encrypt')) {
    /**
     * @param string $text
     *
     * @return mixed
     */
    function encrypt(string $text) : string {
        /** @var $crypt \Phalcon\Crypt */
        $crypt = di()->get('crypt');

        return $crypt->encryptBase64($text);
    }
}

if(!function_exists('decrypt')) {
    /**
     * @param string $text
     *
     * @return mixed
     */
    function decrypt(string $text) : string {
        /** @var $crypt \Phalcon\Crypt */
        $crypt = di()->get('crypt');

        return $crypt->decryptBase64($text);
    }
}

if(!function_exists('logger')) {
    /**
     * @return \Phalcon\Logger
     */
    function logger() : \Phalcon\Logger {
        $logger = di()->get('logger');

        return new \Phalcon\Logger('messages', ['main' => $logger]);
    }
}

if(!function_exists('session')) {
    /**
     * @return \Phalcon\Logger
     */
    function session() : Phalcon\Session\Manager {
        return di()->get('session');
    }
}

if(!function_exists('apcu')) {
    /**
     * @return \Phalcon\Cache\Adapter\Apcu
     */
    function apcu() : \Phalcon\Cache\Adapter\Apcu {
        return di()->get('apcu');
    }
}

if(!function_exists('redis')) {
    /**
     * @return \Phalcon\Cache\Adapter\Redis
     */
    function redis() : \Phalcon\Cache\Adapter\Redis {
        return di()->get('redis');
    }
}