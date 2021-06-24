<?php
function bubblesort(array $array) {
    $length = count($array);

    for($i = 0; $i < $length; $i++) {

        for($j = 0; $j < $length - $i - 1; $j++) {

            echo $length - $i - 1 ."\n";

            $value = $array[$j];

            if($value > $array[$j + 1]){
                $array[$j] = $array[$j + 1];
                $array[$j + 1] = $value;
            }
        }
    }

    print_r($array);
}

$array = [5, 2 , 3, 1];

bubblesort($array);

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
/*

$array = [
    'test' => 'test1',
    'hello'
];

print_r($array);

unset($array['test']);

print_r($array);*/