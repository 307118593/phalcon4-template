<?php

class ExampleTest extends TestCase {

    public function test_example_action_response() {
        $this->assertEquals('production', app()->environment());
    }
}