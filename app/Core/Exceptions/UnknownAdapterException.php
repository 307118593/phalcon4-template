<?php

namespace App\Core\Exceptions;

class UnknownAdapterException extends BaseException {

    protected $message = self::UNKNOWN_ADAPTER_CODE;
    protected $code = self::UNKNOWN_ADAPTER_MESSAGE;
}