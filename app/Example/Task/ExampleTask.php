<?php

namespace App\Example\Task;

use App\Core\Task\BaseTask;

class ExampleTask extends BaseTask {

    public function exampleAction() {
        echo 'This is example action!'.PHP_EOL;
    }
}