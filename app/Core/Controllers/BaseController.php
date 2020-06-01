<?php

namespace App\Core\Controllers;

use App\Core\Exceptions\NotFoundHttpException;

class BaseController {

    protected function response(array $data, int $code = 200, string $message = 'OK') : string {
        return prettyResponse($data, $message, $this->makeStatusBy($code), $code);
    }

    /**
     * @throws \App\Core\Exceptions\NotFoundHttpException
     */
    public function exitAction() { throw new NotFoundHttpException();}

    private function makeStatusBy(int $code) : string {
        switch ($code) {
            case 404:
            case 200:
                return 'success';
            case 500:
                return 'error';
            case 0:
            default:
                return 'fatal';
        }
    }

}