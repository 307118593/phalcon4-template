<?php

error_reporting(E_ALL);
$root = dirname(__DIR__);

try {
    /** Autoload dependencies */
    require_once $root . '/vendor/autoload.php';

    /** Run Test setup */
    (new \App\Core\TestCase($root))->build();

} catch (Throwable $e) {
    /** Catch any throwable */
    $trace = null;

    error_log($e->getMessage());
    logger()->error($e->getMessage());

    $trace = $e->getTrace();

    Sentry\captureException($e);

    echo $e->getMessage().PHP_EOL;
    echo nl2br(htmlentities($e->getTraceAsString()));
    exit;
}