<?php

namespace App\Core\Exceptions;

use App\Core\Interfaces\ExceptionInterface;

class BaseException extends \Exception implements ExceptionInterface {

    public bool $sentry = TRUE;

    public function __construct(?string $message = NULL, ?int $code = NULL, array $data = NULL) {
        parent::__construct($message ?? $this->message, $code ?? $this->code);

        \Sentry\configureScope(function (\Sentry\State\Scope $scope) use ($data) : void {
            if($data !== NULL) {
                foreach($data as $key => $field) $scope->setExtra(is_int($key) ? "key_$key" : $key, json_encode($field,JSON_PRETTY_PRINT|JSON_FORCE_OBJECT));
            }
        });
    }
}