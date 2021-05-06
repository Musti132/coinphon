<?php
/*

enum Status
{
    case DRAFT;
    case PUBLISHED;
    case ARCHIVED;
    
    public function color(): string
    {
        return match($this) 
        {
            Status::DRAFT => 'grey',   
            Status::PUBLISHED => 'green',   
            Status::ARCHIVED => 'red',   
        };
    }
}

$status = Status::DRAFT;

echo $status->color();


exit;
*/
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

print_r($foo->test()[0]->class);