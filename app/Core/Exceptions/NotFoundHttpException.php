<?php

namespace App\Core\Exceptions;

class NotFoundHttpException extends BaseException {

    protected $message = self::NOT_FOUND_MESSAGE;
    protected $code = self::NOT_FOUND_CODE;

    public bool $sentry = FALSE;
}