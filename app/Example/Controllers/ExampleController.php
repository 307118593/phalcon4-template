<?php

namespace App\Example\Controllers;

use App\Core\Controllers\BaseController;
use App\Example\ExampleModel;

class ExampleController extends BaseController{

    public function exampleAction() {
        return $this->response([],200,'Everything working!');
    }

    public function exampleModelAction() {
        $rows = ExampleModel::findFirst(1);

        dd($rows);
    }
}