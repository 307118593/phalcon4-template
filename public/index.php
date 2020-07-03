<?php

use App\Core\Application;

error_reporting(E_ALL);
$root = dirname(__DIR__);

try {
    /** Autoload dependencies */
    require_once $root . '/vendor/autoload.php';

    /** Run Application */
    (new Application($root))->build();

} catch (Throwable $e) {
    /** Catch any throwable */

    $trace = null;

    error_log($e->getMessage());
    logger()->error($e->getMessage());

    $response = prettyResponse([],$e->getMessage(),'exception',$e->getCode(), $trace);

    header('Content-Type:application/json');
    header('Content-Length:'.strlen($response));

    /** if not running on production */
    if(!app()->environment('production')) $trace = $e->getTrace();

    /** if running on production */
    if(!empty($e->sentry) && $e->sentry && !app()->environment('local')) Sentry\captureException($e);

    echo $response;

    exit;
}