<?php

/*
Class Foo {

    public $test = "hello";
    public $data = "test";

    public function run(){
        return "RUN";
    }

    public function bar(){
        return "BAR";
    }

    public function test(){
        $reflect = new ReflectionClass($this);
        return $reflect->getProperties();
    }
}

$foo = new Foo();

print_r($foo->test()[0]->class);*/

$array = [
    'test' => 'test1',
    'hello'
];

print_r($array);

unset($array['test']);

print_r($array);