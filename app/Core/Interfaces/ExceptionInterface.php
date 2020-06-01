<?php

namespace App\Core\Interfaces;

interface ExceptionInterface {

    const NOT_FOUND_CODE          = 404;

    const NOT_FOUND_MESSAGE       = 'This request isn\'t handled by our resources.';

    const ACCESS_DENIED_CODE      = 403;

    const ACCESS_DENIED_MESSAGE   = 'This request isn\'t allowed.';

    const UNKNOWN_ADAPTER_CODE    = 500;

    const UNKNOWN_ADAPTER_MESSAGE = 'This adapter isn\'t defined.';

}