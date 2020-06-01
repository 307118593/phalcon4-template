<?php

namespace App\Core\Exceptions;

class SuppressedException extends BaseException {

    public bool $sentry = FALSE;

}