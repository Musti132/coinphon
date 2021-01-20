<?php
namespace SatPay\Bitcoin;

use Illuminate\Support\ServiceProvider;

class BitcoinServiceProvider extends ServiceProvider{


    public function boot(){
    }

    public function register(){
        $this->app->singleton(AddressGenerator::class, function(){
            return new AddressGenerator();
        });
    }

}

?>