<?php

namespace App\Example\Controllers;

use App\Core\Controllers\BaseController;
use App\Example\ExampleModel;

class ExampleController extends BaseController {

    public function exampleAction() {
        return $this->response([], 200, 'Everything working!');
    }

    /**
     * Example code for model <-> table searching
     *
     * @throws \Exception
     */
    public function exampleModelAction() {
        $rows = ExampleModel::findOrFail(1)->toArray();

        return $this->response($rows);
    }

}