<?php
namespace SatPay\KeyGenerator;

use Illuminate\Support\ServiceProvider;

class KeyGeneratorServiceProvider extends ServiceProvider{


    public function boot(){
    }

    public function register(){
        $this->app->singleton(Generator::class, function(){
            return new Generator();
        });
    }

}

?>