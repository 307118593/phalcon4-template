<?php

namespace App\Core\Exceptions;

class AccessDeniedException extends BaseException {

    protected $message = self::ACCESS_DENIED_MESSAGE;
    protected $code = self::ACCESS_DENIED_CODE;
}