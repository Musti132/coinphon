<?php
namespace App\Services;

use RandomLib\Factory;

Class OrderService{

    public function generateOrderId(){
        $factory = new Factory;

        $generator = $factory->getMediumStrengthGenerator();

        return 'PHON'.$generator->generateString(7, '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');
    }
}



?>