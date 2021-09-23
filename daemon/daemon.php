<?php

const TOTAL_FIBO = 20;


function fibonacci(int $totalFibo)
{
    $f1 = 0;
    $f2 = 1;

    echo $f1 . " " . $f2 . " ";

    for ($i = 0; $i <= $totalFibo; $i++) {

        $f3 = $f1 + $f2;

        echo $f3 . " ";

        $f1 = $f2;
        $f2 = $f3;
    }
}

function reverseFibonacci(int $totalFibo)
{
    $f1 = 17711;
    $f2 = 10946;

    echo $f1 . " " . $f2 . " ";

    for ($i = $totalFibo; $i >= 0; $i--) {

        $f3 = $f1 - $f2;

        echo $f3 . " ";

        $f1 = $f2;
        $f2 = $f3;
    }
}

function lucas()
{
    $l1 = 2;
    $l2 = 1;

    echo "{$l1} {$l2} ";

    for ($i = 0; $i <= 20; $i++) {
        $l3 = $l1 + $l2;

        $l1 = $l2;
        $l2 = $l3;

        echo $l3 . " ";
    }
}

function padovan()
{
    $p[0] = 1;
    $p[1] = 1;
    $p[2] = 1;

    echo $p[0] . " " . $p[1] . " " . $p[2] . " ";

    for ($i = 3; $i <= 27; $i++) {
        $p[$i] = $p[$i - 2] + $p[$i - 3];
        
        echo $p[$i] . " ";
    }
}

fibonacci(TOTAL_FIBO);

echo "\n##########REVERSE FIBONACCI#################\n";
reverseFibonacci(TOTAL_FIBO);
echo "\n##########LUCAS#############################\n";
lucas();
echo "\n##########PADOVAN###########################\n";
padovan();

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