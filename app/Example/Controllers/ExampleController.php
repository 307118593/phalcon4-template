<?php

namespace App\Example\Controllers;

use App\Core\Controllers\BaseController;

class ExampleController extends BaseController{

    public function exampleAction() {
        return $this->response([],200,'Everything working!');
    }
}